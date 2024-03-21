@extends('student.master')
@section('header')
@endsection

@section('content')
<div class="modal fade" id="uploadAss" tabindex="-1" aria-labelledby="uploadAssLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-dark">
            <h5 class="modal-title text-white" id="uploadAssLabel">Upload Assessment</h5>
            <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <form id='create_course' method='post' action='{{ route("upload_assessment") }}' class="row text-start g-3" enctype='multipart/form-data'>@csrf
                <!-- Question -->
                <h4 id='ass_title'>Assignment Title</h4>
                <div class="col-12">
                    <label class="form-label">File/Video</label>
                    <input type='hidden' name='user_id' id='upload_user_id'/>
                    <input type='hidden' name='ass_id' id='upload_ass_id'/>
                    <input type='hidden' name='section_id' id='upload_section_id'/>

                    <input name='file[]' required class="form-control" type="file" multiple
                        placeholder="Input course title">
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger-soft my-0"
                data-bs-dismiss="modal">Close</button>
            <button id='c_submita' type="submit" class="btn btn-success my-0">Create</button>
        </div>
        </form>
    </div>
</div>
</div>
<div class="col-xl-9">

    <!-- Title -->


    <div class="row g-4">

        <!-- Course information START -->
        <div class="col-xxl-6">
            <div class="card bg-transparent border rounded-3 h-100">

                <!-- Catd header -->
                <div class="card-header bg-light border-bottom">
                    <h5 class="card-header-title">{{ $course->title }}</h5>
                </div>

                <!-- Card body START -->
                <div class="card-body">

                    <!-- Course image and info START -->
                    <div class="row g-4">
                        <!-- Course image -->
                        <div id='myvideocontent' class="col-md-6">
                            <div id='videocontent' style='display:none'>
                                <div id="divVideo">
                                    <video controls>
                                        <source src="test1.mp4" type="video/mp4" />
                                    </video>
                                </div>
                            </div>
                            <div id='imagecontent'>
                                <img src="https://learn.abovemarts.com/public/courseimage/{{ $course->image}}" class="rounded" alt="">
                            </div>
                            <p class='mb-3 mt-3'>{!! $course->description !!}</p>
                            <ul class="list-group list-group-borderless">
                                <li class="list-group-item">
                                    <span>Release date:</span>
                                    <span class="h6 mb-0">{{ Date("M d,Y",strtotime($course->created_at)) }}</span>
                                </li>

                                {{-- <li class="list-group-item">
                                    <span>Total Hour:</span>
                                    <span class="h6 mb-0">{{ $course->duration }}Hrs</span>
                                </li> --}}

                                <li class="list-group-item">
                                    <span>Total Enrolled:</span>
                                    <span class="h6 mb-0">{{
                                        count(App\Models\Enroll::where('course_id',$course->id)->get()) }}+</span>
                                </li>

                                <li class="list-group-item">
                                    <span>Certificate:</span>
                                    <span class="h6 mb-0">Yes</span>
                                </li>
                                {{-- @if($user->enr->completed == 1)
                                <li class="list-group-item">
                                    <span>Download Certificate:</span>
                                    <a href='/download_certificate/{{ $course->uid }}' class="btn btn-sm btn-success h6 mb-0">Download</a>
                                </li>
                                @else 
                                <div class='alert alert-danger'>Certificate not available</div>
                                @endif --}}
                            </ul>
                        </div>

                        <!-- Course info and avatar -->
                        <div class="col-md-6">
                            <div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
                                <!-- Item START -->
                                {{-- <div class="accordion-item mb-3">
                                    <h6 class="accordion-header font-base" id="heading-0">
                                        <button
                                            class="accordion-button fw-bold rounded d-inline-block collapsed d-block pe-5"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapse-0"
                                            aria-expanded="false" aria-controls="collapse-0">
                                            Course Introduction
                                        </button>
                                    </h6>

                                    <div id="collapse-0" class="accordion-collapse collapse show"
                                        aria-labelledby="heading-0" data-bs-parent="#accordionExample2">
                                        <!-- Topic START -->
                                        <div class="accordion-body mt-3">
                                            <!-- Video item START -->
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="position-relative">
                                                    <a href="#"
                                                        class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"><i
                                                            class="fas fa-play"></i></a>
                                                    <span class="ms-2 mb-0 h6 fw-light">Introduction</span>
                                                </div>
                                                <!-- Edit and cancel button -->
                                                <div>

                                                </div>
                                            </div>
                                            <!-- Divider -->
                                            <hr>

                                            <!-- Add topic -->

                                        </div>
                                        <!-- Topic END -->
                                    </div>
                                </div> --}}

                                @foreach($sections as $key => $section)
                                <div class="accordion-item mb-3">
                                    <h6 class="accordion-header font-base" id="heading-{{ ++$key }}">
                                        <button
                                            class="accordion-button fw-bold rounded d-inline-block collapsed d-block pe-5"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$key }}"
                                            aria-expanded="false" aria-controls="collapse-{{$key }}">
                                            {{$section->title}}
                                        </button>

                                    </h6>

                                    <div id="collapse-{{$key }}" class="accordion-collapse collapse hide"
                                        aria-labelledby="heading-{{ ++$key }}"
                                        data-bs-parent="#accordionExample{{ ++$key }}">
                                        <!-- Topic START -->
                                        <div class="accordion-body mt-3">
                                            <!-- Video item START -->
                                            @foreach(App\Models\SectionVideo::where('section_id',$section->id)->get() as
                                            $video)
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="position-relative">
                                                    <span class="btn btn-sm btn btn-success-soft"> <i
                                                            class="fas fa-list"></i></span>

                                                    <span class="ms-2 mb-0 h6 fw-light">{{ $video->title }}</span>
                                                    @if($video->status == 0)

                                                    @else
                                                    <a href="{{ $video->link }}"
                                                        class="btn btn-secondary-soft btn-round btn-sm mb-0 stretched-link position-static">
                                                        {{-- <i class="fas fa-lock"></i> --}}
                                                    </a>
                                                    @endif
                                                </div>
                                                <!-- Edit and cancel button -->
                                                <div>
                                                    @if($video->status == 0)
                                                    @if($video->ext == 'jpg' || $video->ext == 'png' || $video->ext ==
                                                    'jpeg' || $video->ext == 'jfif')
                                                    <a href="/downloadsectionvideo/{{ $video->id }}"
                                                        class="btn btn-sm btn btn-danger-soft"> <i
                                                            class="fas fa-image"></i></a>
                                                    <a href="/markdone/{{ $course->id }}"
                                                        class="btn btn-sm btn btn-success-soft"> <i
                                                            class="fas fa-check"></i></a>

                                                    @elseif($video->ext == 'pdf' || $video->ext == 'docs' || $video->ext
                                                    == 'docx' || $video->ext == 'xls')
                                                    <a href="/downloadsectionvideo/{{ $video->id }}"
                                                        class="btn btn-sm btn btn-danger-soft"> <i
                                                            class="fas fa-file"></i></a>
                                                    <a href="/markdone/{{ $course->id }}"
                                                        class="btn btn-sm btn btn-success-soft"> <i
                                                            class="fas fa-check"></i></a>

                                                    @elseif($video->ext == 'mp4' || $video->ext == 'mkv' || $video->ext
                                                    == 'webm')
                                                    {{-- <a href="/downloadsectionvideo/{{ $video->id }}" --}} <a
                                                        data-id='{{ $video->video }}' href='#myvideocontent'
                                                        class="playvideo btn btn-sm btn btn-danger-soft"> <i
                                                            class="fas fa-play"></i></a>
                                                    <a href="/markdone/{{ $course->id }}"
                                                        class="btn btn-sm btn btn-success-soft"> <i
                                                            class="fas fa-check"></i></a>

                                                    @else
                                                    <a href="/downloadsectionvideo/{{ $video->id }}"
                                                        class="btn btn-sm btn btn-danger-soft"> <i
                                                            class="fas fa-error"></i></a>
                                                    <a href="/markdone/{{ $course->id }}"
                                                        class="btn btn-sm btn btn-success-soft"> <i
                                                            class="fas fa-check"></i></a>

                                                    @endif
                                                    @else
                                                    <a href='{{ $course->link }}' class="btn btn-sm btn btn-secondary-soft">
                                                         <i
                                                            class="fas fa-check"></i>
                                                        </a>

                                                    @endif




                                                </div>
                                            </div>
                                            <!-- Divider -->
                                            <hr>
                                            @endforeach
                                            @if(count(App\Models\Assignment::where('section_id', $section->id)->get()) > 0)

                                            <h5>Examination</h5>
                                            <hr>

                                            @foreach(App\Models\Assignment::where('section_id',$section->id)->get() as
                                            $ass)
                                           
                                            <div class="d-flex justify-content-between align-items-center">
                                             
                                                <div class="position-relative">
                                                    @if($ass->ext == 'jpg' || $ass->ext == 'png' || $ass->ext ==
                                                    'jpeg' || $ass->ext == 'jfif')
                                                    <a href='#' data-bs-toggle="modal" data-bs-target="#gallery"
                                                        class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                                                        <i class="fas fa-image"></i>
                                                    </a>
                                                    @elseif($ass->ext == 'pdf' || $ass->ext == 'docs' || $ass->ext
                                                    == 'docx' || $ass->ext == 'xls')
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#gallery"
                                                        class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                                                        <i class="fas fa-file"></i>
                                                    </a>
                                                    @elseif($ass->ext == 'mp4' || $ass->ext == 'mkv' || $ass->ext
                                                    == 'webm')
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#gallery"
                                                        class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                                                        <i class="fas fa-play"></i>
                                                    </a>
                                                    @elseif($ass->link !== null)
                                                    <a data-bs-toggle="modal" data-bs-target="#gallery"
                                                        class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                                                        <i class="fas fa-link"></i>
                                                    </a>
                                                    @else
                                                    <a href="/downloadsectionvideo/{{ $ass->id }}"
                                                        class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    @endif
                                                    <span class=" ms-2 mb-0 h6 fw-light">{{ $ass->title }} (${{ number_format($ass->price) }})</span>
                                                    @if($ass->status == 0)
                                                    <a href="#"
                                                        class="btn btn-info-soft btn-round btn-sm mb-0 stretched-link position-static">
                                                        <i class="fas fa-unlock"></i>
                                                    </a>
                                                    @else
                                                    <a href="#"
                                                        class="btn btn-secondary-soft btn-round btn-sm mb-0 stretched-link position-static">

                                                    </a>
                                                    @endif
                                                </div>
                                                <!-- Edit and cancel button -->
                                                <div>
                                                    @if($ass->price == 0 || $payment == true)
                                                    @if($ass->type == 'objectives')
                                                    <a href="/starttest/{{ $ass->id }}"
                                                        class="btn btn-sm btn btn-info-soft">Start Test</a>
                                                    <a href="/checkuserresult/{{ $user->id }}/{{ $ass->id }}"
                                                        class="btn btn-sm btn btn-info-soft">View Result</a>
                                                    @else
                                                    @if($ass->link !== null)
                                                    {{ $ass->uploaded($user->id,$ass->id)->is_done ?? "Not Done"  }}
                                                  
                                                    <a onclick="return swal('{{ $ass->link }}','Copy Assignment Link','info')"
                                                        class="btn btn-sm btn btn-info-soft">View Link</a>
                                                        <a data-section="{{ $section->id }}" data-title = '{{ $ass->title }}' data-id='{{ $ass->id }}' data-user_id = "{{ $user->id }}"  data-bs-toggle="modal" data-bs-target="#uploadAss" class='upload_ass btn btn-sm btn-info'><i class='fa fa-upload'></i></a>
                                                    @elseif($ass->ext == 'mp4' || $ass->ext == 'mkv' || $ass->ext
                                                    == 'webm')
                                                       {{ $ass->uploaded($user->id,$ass->id)->is_done ?? "Not Done"  }}
                                                    <a href='#'
                                                    data-id='{{ $ass->file }}'
                                                    class="playass btn btn-sm btn btn-danger-soft"> <i
                                                        class="fas fa-play"></i> Play</a>
                                                        <a data-section="{{ $section->id }}" data-title = '{{ $ass->title }}' data-id='{{ $ass->id }}' data-user_id = "{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#uploadAss" class='upload_ass btn btn-sm btn-info'><i class='fa fa-upload'></i></a>
                                                   
                                                    @else
                                                    {{ $ass->uploaded($user->id,$ass->id)->is_done ?? "Not Done"  }}
                                                    <a href="/viewass/{{ $ass->uid }}"
                                                        class="btn btn-sm btn btn-info-soft">View</a>
                                                        <a data-section="{{ $section->id }}" data-title = '{{ $ass->title }}' data-id='{{ $ass->id }}'data-bs-toggle="modal" data-bs-target="#uploadAss"  data-user_id = "{{ $user->id }}" class='upload_ass btn btn-sm btn-info'><i class='fa fa-upload'></i></a>
                                                   
                                                        @endif
                                                    @endif
                                                    @else 
                                                    <a href='/payForExam/{{ $user->id }}/{{ $ass->id }}' class='btn sm btn-success'>Pay For Exam</a>
                                                    @endif
                                                </div>
                                            </div>
                                         
                                            <!-- Divider -->
                                            <hr>
                                            @endforeach

                                            @endif

                                            <hr>
                                            <h5>Announcements</h5>

                                            <!-- Video item END -->

                                            <!-- Video item START -->

                                            <!-- Divider -->
                                            <hr>
                                            <!-- Video item END -->

                                            <!-- Add topic -->


                                        </div>
                                        <!-- Topic END -->
                                    </div>
                                </div>
                                @endforeach
                                <!-- Item END -->


                                <!-- Item END -->

                            </div>
                        </div>
                    </div>
                    <!-- Course image and info END -->

                    <!-- Information START -->
                    <div class="row mt-3">

                        <!-- Information item -->


                        <!-- Information item -->
                        <div class="col-md-6">

                        </div>
                    </div>
                    <!-- Information END -->
                </div>
                <!-- Card body END -->
            </div>
        </div>
        <!-- Course information END -->

        <!-- Chart START -->
        <div class="col-xxl-6">
            <div class="row g-4">

                <!-- Active student START -->
                <div class="col-md-6 col-xxl-12">
                    <div class="card bg-transparent border overflow-hidden">
                        <!-- Card header -->
                        <div class="card-header bg-light border-bottom">
                            <h5 class="card-header-title mb-0">Success Stories</h5>
                        </div>
                        <!-- Card body -->
                        <div class="card-body p-0" style="position: relative;">
                            <div class="d-sm-flex justify-content-between p-4">
                                <h4 class="text-blue mb-0">{{
                                    count(App\Models\Enroll::where('course_id',$course->id)->get()) }}+</h4>
                                <p class="mb-0"><span class="text-success me-1">0.20%<i
                                            class="bi bi-arrow-up"></i></span>vs last Week</p>
                            </div>
                            <!-- Apex chart -->
                            <div id="activeChartstudent" style="min-height: 130px;">
                                <div id="apexchartsymwe91zv"
                                    class="apexcharts-canvas apexchartsymwe91zv apexcharts-theme-light"
                                    style="width: 409px; height: 130px;"><svg id="SvgjsSvg1205" width="409" height="130"
                                        xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                        class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                        style="background: transparent;">
                                        <g id="SvgjsG1207" class="apexcharts-inner apexcharts-graphical"
                                            transform="translate(0, 0)">
                                            <defs id="SvgjsDefs1206">
                                                <clipPath id="gridRectMaskymwe91zv">
                                                    <rect id="SvgjsRect1212" width="417" height="134" x="-4" y="-2"
                                                        rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fff"></rect>
                                                </clipPath>
                                                <clipPath id="forecastMaskymwe91zv"></clipPath>
                                                <clipPath id="nonForecastMaskymwe91zv"></clipPath>
                                                <clipPath id="gridRectMarkerMaskymwe91zv">
                                                    <rect id="SvgjsRect1213" width="413" height="134" x="-2" y="-2"
                                                        rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fff"></rect>
                                                </clipPath>
                                                <linearGradient id="SvgjsLinearGradient1218" x1="0" y1="0" x2="0"
                                                    y2="1">
                                                    <stop id="SvgjsStop1219" stop-opacity="0.65"
                                                        stop-color="rgba(12,188,135,0.65)" offset="0"></stop>
                                                    <stop id="SvgjsStop1220" stop-opacity="0.5"
                                                        stop-color="rgba(134,222,195,0.5)" offset="1"></stop>
                                                    <stop id="SvgjsStop1221" stop-opacity="0.5"
                                                        stop-color="rgba(134,222,195,0.5)" offset="1"></stop>
                                                </linearGradient>
                                            </defs>
                                            <line id="SvgjsLine1211" x1="0" y1="0" x2="0" y2="130" stroke="#b6b6b6"
                                                stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0"
                                                width="1" height="130" fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                                stroke-width="1"></line>
                                            <g id="SvgjsG1224" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                <g id="SvgjsG1225" class="apexcharts-xaxis-texts-g"
                                                    transform="translate(0, -4)"></g>
                                            </g>
                                            <g id="SvgjsG1235" class="apexcharts-grid">
                                                <g id="SvgjsG1236" class="apexcharts-gridlines-horizontal"
                                                    style="display: none;">
                                                    <line id="SvgjsLine1238" x1="0" y1="0" x2="409" y2="0"
                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1239" x1="0" y1="18.571428571428573" x2="409"
                                                        y2="18.571428571428573" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1240" x1="0" y1="37.142857142857146" x2="409"
                                                        y2="37.142857142857146" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1241" x1="0" y1="55.71428571428572" x2="409"
                                                        y2="55.71428571428572" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1242" x1="0" y1="74.28571428571429" x2="409"
                                                        y2="74.28571428571429" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1243" x1="0" y1="92.85714285714286" x2="409"
                                                        y2="92.85714285714286" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1244" x1="0" y1="111.42857142857143" x2="409"
                                                        y2="111.42857142857143" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1245" x1="0" y1="130" x2="409" y2="130"
                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                </g>
                                                <g id="SvgjsG1237" class="apexcharts-gridlines-vertical"
                                                    style="display: none;"></g>
                                                <line id="SvgjsLine1247" x1="0" y1="130" x2="409" y2="130"
                                                    stroke="transparent" stroke-dasharray="0"></line>
                                                <line id="SvgjsLine1246" x1="0" y1="1" x2="0" y2="130"
                                                    stroke="transparent" stroke-dasharray="0"></line>
                                            </g>
                                            <g id="SvgjsG1214" class="apexcharts-area-series apexcharts-plot-series">
                                                <g id="SvgjsG1215" class="apexcharts-series" seriesName="Conversion"
                                                    data:longestSeries="true" rel="1" data:realIndex="0">
                                                    <path id="SvgjsPath1222"
                                                        d="M 0 130L 0 111.42857142857142C 20.45 111.42857142857142 37.97857142857143 94.7142857142857 58.42857142857143 94.7142857142857C 78.87857142857143 94.7142857142857 96.40714285714286 55.71428571428571 116.85714285714286 55.71428571428571C 137.30714285714288 55.71428571428571 154.8357142857143 55.71428571428571 175.2857142857143 55.71428571428571C 195.7357142857143 55.71428571428571 213.26428571428573 68.71428571428571 233.71428571428572 68.71428571428571C 254.1642857142857 68.71428571428571 271.6928571428572 89.88571428571427 292.14285714285717 89.88571428571427C 312.59285714285716 89.88571428571427 330.1214285714286 59.8 350.5714285714286 59.8C 371.0214285714286 59.8 388.55 18.571428571428555 409 18.571428571428555C 409 18.571428571428555 409 18.571428571428555 409 130M 409 18.571428571428555z"
                                                        fill="url(#SvgjsLinearGradient1218)" fill-opacity="1"
                                                        stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                        stroke-dasharray="0" class="apexcharts-area" index="0"
                                                        clip-path="url(#gridRectMaskymwe91zv)"
                                                        pathTo="M 0 130L 0 111.42857142857142C 20.45 111.42857142857142 37.97857142857143 94.7142857142857 58.42857142857143 94.7142857142857C 78.87857142857143 94.7142857142857 96.40714285714286 55.71428571428571 116.85714285714286 55.71428571428571C 137.30714285714288 55.71428571428571 154.8357142857143 55.71428571428571 175.2857142857143 55.71428571428571C 195.7357142857143 55.71428571428571 213.26428571428573 68.71428571428571 233.71428571428572 68.71428571428571C 254.1642857142857 68.71428571428571 271.6928571428572 89.88571428571427 292.14285714285717 89.88571428571427C 312.59285714285716 89.88571428571427 330.1214285714286 59.8 350.5714285714286 59.8C 371.0214285714286 59.8 388.55 18.571428571428555 409 18.571428571428555C 409 18.571428571428555 409 18.571428571428555 409 130M 409 18.571428571428555z"
                                                        pathFrom="M -1 148.57142857142856L -1 148.57142857142856L 58.42857142857143 148.57142857142856L 116.85714285714286 148.57142857142856L 175.2857142857143 148.57142857142856L 233.71428571428572 148.57142857142856L 292.14285714285717 148.57142857142856L 350.5714285714286 148.57142857142856L 409 148.57142857142856">
                                                    </path>
                                                    <path id="SvgjsPath1223"
                                                        d="M 0 111.42857142857142C 20.45 111.42857142857142 37.97857142857143 94.7142857142857 58.42857142857143 94.7142857142857C 78.87857142857143 94.7142857142857 96.40714285714286 55.71428571428571 116.85714285714286 55.71428571428571C 137.30714285714288 55.71428571428571 154.8357142857143 55.71428571428571 175.2857142857143 55.71428571428571C 195.7357142857143 55.71428571428571 213.26428571428573 68.71428571428571 233.71428571428572 68.71428571428571C 254.1642857142857 68.71428571428571 271.6928571428572 89.88571428571427 292.14285714285717 89.88571428571427C 312.59285714285716 89.88571428571427 330.1214285714286 59.8 350.5714285714286 59.8C 371.0214285714286 59.8 388.55 18.571428571428555 409 18.571428571428555"
                                                        fill="none" fill-opacity="1" stroke="#0cbc87" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="4" stroke-dasharray="0"
                                                        class="apexcharts-area" index="0"
                                                        clip-path="url(#gridRectMaskymwe91zv)"
                                                        pathTo="M 0 111.42857142857142C 20.45 111.42857142857142 37.97857142857143 94.7142857142857 58.42857142857143 94.7142857142857C 78.87857142857143 94.7142857142857 96.40714285714286 55.71428571428571 116.85714285714286 55.71428571428571C 137.30714285714288 55.71428571428571 154.8357142857143 55.71428571428571 175.2857142857143 55.71428571428571C 195.7357142857143 55.71428571428571 213.26428571428573 68.71428571428571 233.71428571428572 68.71428571428571C 254.1642857142857 68.71428571428571 271.6928571428572 89.88571428571427 292.14285714285717 89.88571428571427C 312.59285714285716 89.88571428571427 330.1214285714286 59.8 350.5714285714286 59.8C 371.0214285714286 59.8 388.55 18.571428571428555 409 18.571428571428555"
                                                        pathFrom="M -1 148.57142857142856L -1 148.57142857142856L 58.42857142857143 148.57142857142856L 116.85714285714286 148.57142857142856L 175.2857142857143 148.57142857142856L 233.71428571428572 148.57142857142856L 292.14285714285717 148.57142857142856L 350.5714285714286 148.57142857142856L 409 148.57142857142856">
                                                    </path>
                                                    <g id="SvgjsG1216" class="apexcharts-series-markers-wrap"
                                                        data:realIndex="0">
                                                        <g class="apexcharts-series-markers">
                                                            <circle id="SvgjsCircle1253" r="0" cx="0" cy="0"
                                                                class="apexcharts-marker w44533kzx no-pointer-events"
                                                                stroke="#ffffff" fill="#0cbc87" fill-opacity="1"
                                                                stroke-width="2" stroke-opacity="0.9"
                                                                default-marker-size="0"></circle>
                                                        </g>
                                                    </g>
                                                </g>
                                                <g id="SvgjsG1217" class="apexcharts-datalabels" data:realIndex="0"></g>
                                            </g>
                                            <line id="SvgjsLine1248" x1="0" y1="0" x2="409" y2="0" stroke="#b6b6b6"
                                                stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs">
                                            </line>
                                            <line id="SvgjsLine1249" x1="0" y1="0" x2="409" y2="0" stroke-dasharray="0"
                                                stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                            <g id="SvgjsG1250" class="apexcharts-yaxis-annotations"></g>
                                            <g id="SvgjsG1251" class="apexcharts-xaxis-annotations"></g>
                                            <g id="SvgjsG1252" class="apexcharts-point-annotations"></g>
                                        </g>
                                        <rect id="SvgjsRect1210" width="0" height="0" x="0" y="0" rx="0" ry="0"
                                            opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                            fill="#fefefe"></rect>
                                        <g id="SvgjsG1234" class="apexcharts-yaxis" rel="0"
                                            transform="translate(-18, 0)"></g>
                                        <g id="SvgjsG1208" class="apexcharts-annotations"></g>
                                    </svg>
                                    <div class="apexcharts-legend" style="max-height: 65px;"></div>
                                    <div class="apexcharts-tooltip apexcharts-theme-light">
                                        <div class="apexcharts-tooltip-title"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                                        <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                class="apexcharts-tooltip-marker"
                                                style="background-color: rgb(12, 188, 135);"></span>
                                            <div class="apexcharts-tooltip-text"
                                                style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                <div class="apexcharts-tooltip-y-group"><span
                                                        class="apexcharts-tooltip-text-y-label"></span><span
                                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                                <div class="apexcharts-tooltip-goals-group"><span
                                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                                <div class="apexcharts-tooltip-z-group"><span
                                                        class="apexcharts-tooltip-text-z-label"></span><span
                                                        class="apexcharts-tooltip-text-z-value"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                        <div class="apexcharts-yaxistooltip-text"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 410px; height: 215px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Active student END -->

                <!-- Enrolled START -->
                <div class="col-md-6 col-xxl-12">
                    <div class="card bg-transparent border overflow-hidden">
                        <!-- Card header -->
                        <div class="card-header bg-light border-bottom">
                            <h5 class="card-header-title mb-0">New Enrollment This Month</h5>
                        </div>
                        <!-- Card body -->
                        <div class="card-body p-0" style="position: relative;">
                            <div class="d-sm-flex justify-content-between p-4">
                                <h4 class="text-blue mb-0">{{
                                    count(App\Models\Enroll::where('course_id',$course->id)->get()) }}</h4>
                                <p class="mb-0"><span class="text-success me-1">0.35%<i
                                            class="bi bi-arrow-up"></i></span>vs last Week</p>
                            </div>
                            <!-- Apex chart -->
                            <div id="activeChartstudent2" style="min-height: 130px;">
                                <div id="apexchartszpyu1jea"
                                    class="apexcharts-canvas apexchartszpyu1jea apexcharts-theme-light"
                                    style="width: 409px; height: 130px;"><svg id="SvgjsSvg1255" width="409" height="130"
                                        xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                        class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                        style="background: transparent;">
                                        <g id="SvgjsG1257" class="apexcharts-inner apexcharts-graphical"
                                            transform="translate(0, 0)">
                                            <defs id="SvgjsDefs1256">
                                                <clipPath id="gridRectMaskzpyu1jea">
                                                    <rect id="SvgjsRect1262" width="417" height="134" x="-4" y="-2"
                                                        rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fff"></rect>
                                                </clipPath>
                                                <clipPath id="forecastMaskzpyu1jea"></clipPath>
                                                <clipPath id="nonForecastMaskzpyu1jea"></clipPath>
                                                <clipPath id="gridRectMarkerMaskzpyu1jea">
                                                    <rect id="SvgjsRect1263" width="413" height="134" x="-2" y="-2"
                                                        rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fff"></rect>
                                                </clipPath>
                                                <linearGradient id="SvgjsLinearGradient1268" x1="0" y1="0" x2="0"
                                                    y2="1">
                                                    <stop id="SvgjsStop1269" stop-opacity="0.65"
                                                        stop-color="rgba(111,66,193,0.65)" offset="0"></stop>
                                                    <stop id="SvgjsStop1270" stop-opacity="0.5"
                                                        stop-color="rgba(183,161,224,0.5)" offset="1"></stop>
                                                    <stop id="SvgjsStop1271" stop-opacity="0.5"
                                                        stop-color="rgba(183,161,224,0.5)" offset="1"></stop>
                                                </linearGradient>
                                            </defs>
                                            <line id="SvgjsLine1261" x1="0" y1="0" x2="0" y2="130" stroke="#b6b6b6"
                                                stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0"
                                                width="1" height="130" fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                                stroke-width="1"></line>
                                            <g id="SvgjsG1274" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                <g id="SvgjsG1275" class="apexcharts-xaxis-texts-g"
                                                    transform="translate(0, -4)"></g>
                                            </g>
                                            <g id="SvgjsG1285" class="apexcharts-grid">
                                                <g id="SvgjsG1286" class="apexcharts-gridlines-horizontal"
                                                    style="display: none;">
                                                    <line id="SvgjsLine1288" x1="0" y1="0" x2="409" y2="0"
                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1289" x1="0" y1="18.571428571428573" x2="409"
                                                        y2="18.571428571428573" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1290" x1="0" y1="37.142857142857146" x2="409"
                                                        y2="37.142857142857146" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1291" x1="0" y1="55.71428571428572" x2="409"
                                                        y2="55.71428571428572" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1292" x1="0" y1="74.28571428571429" x2="409"
                                                        y2="74.28571428571429" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1293" x1="0" y1="92.85714285714286" x2="409"
                                                        y2="92.85714285714286" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1294" x1="0" y1="111.42857142857143" x2="409"
                                                        y2="111.42857142857143" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1295" x1="0" y1="130" x2="409" y2="130"
                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                </g>
                                                <g id="SvgjsG1287" class="apexcharts-gridlines-vertical"
                                                    style="display: none;"></g>
                                                <line id="SvgjsLine1297" x1="0" y1="130" x2="409" y2="130"
                                                    stroke="transparent" stroke-dasharray="0"></line>
                                                <line id="SvgjsLine1296" x1="0" y1="1" x2="0" y2="130"
                                                    stroke="transparent" stroke-dasharray="0"></line>
                                            </g>
                                            <g id="SvgjsG1264" class="apexcharts-area-series apexcharts-plot-series">
                                                <g id="SvgjsG1265" class="apexcharts-series" seriesName="Conversion"
                                                    data:longestSeries="true" rel="1" data:realIndex="0">
                                                    <path id="SvgjsPath1272"
                                                        d="M 0 130L 0 111.42857142857142C 20.45 111.42857142857142 37.97857142857143 94.7142857142857 58.42857142857143 94.7142857142857C 78.87857142857143 94.7142857142857 96.40714285714286 88.2142857142857 116.85714285714286 88.2142857142857C 137.30714285714288 88.2142857142857 154.8357142857143 55.71428571428571 175.2857142857143 55.71428571428571C 195.7357142857143 55.71428571428571 213.26428571428573 37.14285714285714 233.71428571428572 37.14285714285714C 254.1642857142857 37.14285714285714 271.6928571428572 89.88571428571427 292.14285714285717 89.88571428571427C 312.59285714285716 89.88571428571427 330.1214285714286 59.8 350.5714285714286 59.8C 371.0214285714286 59.8 388.55 18.571428571428555 409 18.571428571428555C 409 18.571428571428555 409 18.571428571428555 409 130M 409 18.571428571428555z"
                                                        fill="url(#SvgjsLinearGradient1268)" fill-opacity="1"
                                                        stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                        stroke-dasharray="0" class="apexcharts-area" index="0"
                                                        clip-path="url(#gridRectMaskzpyu1jea)"
                                                        pathTo="M 0 130L 0 111.42857142857142C 20.45 111.42857142857142 37.97857142857143 94.7142857142857 58.42857142857143 94.7142857142857C 78.87857142857143 94.7142857142857 96.40714285714286 88.2142857142857 116.85714285714286 88.2142857142857C 137.30714285714288 88.2142857142857 154.8357142857143 55.71428571428571 175.2857142857143 55.71428571428571C 195.7357142857143 55.71428571428571 213.26428571428573 37.14285714285714 233.71428571428572 37.14285714285714C 254.1642857142857 37.14285714285714 271.6928571428572 89.88571428571427 292.14285714285717 89.88571428571427C 312.59285714285716 89.88571428571427 330.1214285714286 59.8 350.5714285714286 59.8C 371.0214285714286 59.8 388.55 18.571428571428555 409 18.571428571428555C 409 18.571428571428555 409 18.571428571428555 409 130M 409 18.571428571428555z"
                                                        pathFrom="M -1 148.57142857142856L -1 148.57142857142856L 58.42857142857143 148.57142857142856L 116.85714285714286 148.57142857142856L 175.2857142857143 148.57142857142856L 233.71428571428572 148.57142857142856L 292.14285714285717 148.57142857142856L 350.5714285714286 148.57142857142856L 409 148.57142857142856">
                                                    </path>
                                                    <path id="SvgjsPath1273"
                                                        d="M 0 111.42857142857142C 20.45 111.42857142857142 37.97857142857143 94.7142857142857 58.42857142857143 94.7142857142857C 78.87857142857143 94.7142857142857 96.40714285714286 88.2142857142857 116.85714285714286 88.2142857142857C 137.30714285714288 88.2142857142857 154.8357142857143 55.71428571428571 175.2857142857143 55.71428571428571C 195.7357142857143 55.71428571428571 213.26428571428573 37.14285714285714 233.71428571428572 37.14285714285714C 254.1642857142857 37.14285714285714 271.6928571428572 89.88571428571427 292.14285714285717 89.88571428571427C 312.59285714285716 89.88571428571427 330.1214285714286 59.8 350.5714285714286 59.8C 371.0214285714286 59.8 388.55 18.571428571428555 409 18.571428571428555"
                                                        fill="none" fill-opacity="1" stroke="#6f42c1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="4" stroke-dasharray="0"
                                                        class="apexcharts-area" index="0"
                                                        clip-path="url(#gridRectMaskzpyu1jea)"
                                                        pathTo="M 0 111.42857142857142C 20.45 111.42857142857142 37.97857142857143 94.7142857142857 58.42857142857143 94.7142857142857C 78.87857142857143 94.7142857142857 96.40714285714286 88.2142857142857 116.85714285714286 88.2142857142857C 137.30714285714288 88.2142857142857 154.8357142857143 55.71428571428571 175.2857142857143 55.71428571428571C 195.7357142857143 55.71428571428571 213.26428571428573 37.14285714285714 233.71428571428572 37.14285714285714C 254.1642857142857 37.14285714285714 271.6928571428572 89.88571428571427 292.14285714285717 89.88571428571427C 312.59285714285716 89.88571428571427 330.1214285714286 59.8 350.5714285714286 59.8C 371.0214285714286 59.8 388.55 18.571428571428555 409 18.571428571428555"
                                                        pathFrom="M -1 148.57142857142856L -1 148.57142857142856L 58.42857142857143 148.57142857142856L 116.85714285714286 148.57142857142856L 175.2857142857143 148.57142857142856L 233.71428571428572 148.57142857142856L 292.14285714285717 148.57142857142856L 350.5714285714286 148.57142857142856L 409 148.57142857142856">
                                                    </path>
                                                    <g id="SvgjsG1266" class="apexcharts-series-markers-wrap"
                                                        data:realIndex="0">
                                                        <g class="apexcharts-series-markers">
                                                            <circle id="SvgjsCircle1303" r="0" cx="0" cy="0"
                                                                class="apexcharts-marker w4yyudphk no-pointer-events"
                                                                stroke="#ffffff" fill="#6f42c1" fill-opacity="1"
                                                                stroke-width="2" stroke-opacity="0.9"
                                                                default-marker-size="0"></circle>
                                                        </g>
                                                    </g>
                                                </g>
                                                <g id="SvgjsG1267" class="apexcharts-datalabels" data:realIndex="0"></g>
                                            </g>
                                            <line id="SvgjsLine1298" x1="0" y1="0" x2="409" y2="0" stroke="#b6b6b6"
                                                stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs">
                                            </line>
                                            <line id="SvgjsLine1299" x1="0" y1="0" x2="409" y2="0" stroke-dasharray="0"
                                                stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                            <g id="SvgjsG1300" class="apexcharts-yaxis-annotations"></g>
                                            <g id="SvgjsG1301" class="apexcharts-xaxis-annotations"></g>
                                            <g id="SvgjsG1302" class="apexcharts-point-annotations"></g>
                                        </g>
                                        <rect id="SvgjsRect1260" width="0" height="0" x="0" y="0" rx="0" ry="0"
                                            opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                            fill="#fefefe"></rect>
                                        <g id="SvgjsG1284" class="apexcharts-yaxis" rel="0"
                                            transform="translate(-18, 0)"></g>
                                        <g id="SvgjsG1258" class="apexcharts-annotations"></g>
                                    </svg>
                                    <div class="apexcharts-legend" style="max-height: 65px;"></div>
                                    <div class="apexcharts-tooltip apexcharts-theme-light">
                                        <div class="apexcharts-tooltip-title"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                                        <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                class="apexcharts-tooltip-marker"
                                                style="background-color: rgb(111, 66, 193);"></span>
                                            <div class="apexcharts-tooltip-text"
                                                style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                <div class="apexcharts-tooltip-y-group"><span
                                                        class="apexcharts-tooltip-text-y-label"></span><span
                                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                                <div class="apexcharts-tooltip-goals-group"><span
                                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                                <div class="apexcharts-tooltip-z-group"><span
                                                        class="apexcharts-tooltip-text-z-label"></span><span
                                                        class="apexcharts-tooltip-text-z-value"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                        <div class="apexcharts-yaxistooltip-text"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 410px; height: 215px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Enrolled END -->

            </div>
        </div>
        <!-- Chart END -->

        <!-- Student review START -->
        {{-- <div class="col-12">
            <div class="card bg-transparent border">

                <!-- Card header START -->
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">Students Reviews</h5>
                </div>
                <!-- Card header END -->

                <!-- Card body START -->
                <div class="card-body pb-0">
                    <!-- Table START -->
                    <div class="table-responsive border-0">
                        <table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
                            <!-- Table head -->
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 rounded-start">Student Name</th>
                                    <th scope="col" class="border-0">Date</th>
                                    <th scope="col" class="border-0">Rating</th>
                                    <th scope="col" class="border-0 rounded-end">Action</th>
                                </tr>
                            </thead>

                            <!-- Table body START -->
                            <tbody>
                                <!-- Table row -->
                                <tr>
                                    <!-- Table data -->
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <!-- Image -->
                                            <div class="avatar avatar-xs mb-2 mb-md-0">
                                                <img src="assets/images/avatar/09.jpg" class="rounded-circle" alt="">
                                            </div>
                                            <div class="mb-0 ms-2">
                                                <!-- Title -->
                                                <h6 class="mb-0"><a href="#" class="stretched-link">Agbeniga Ambali</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Table data -->
                                    <td class="text-center text-sm-start">
                                        <h6 class="mb-0">29 Nov 2023</h6>
                                    </td>

                                    <!-- Table data -->
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                        </ul>
                                    </td>

                                    <!-- Table data -->
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info-soft mb-0" data-bs-toggle="modal"
                                            data-bs-target="#viewReview">View</a>
                                        <button class="btn btn-sm btn-danger-soft me-1 mb-1 mb-md-0">Delete</button>
                                    </td>
                                </tr>

                                <!-- Table row -->
                                <tr>
                                    <!-- Table data -->
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <!-- Image -->
                                            <div class="avatar avatar-xs mb-2 mb-md-0">
                                                <img src="assets/images/avatar/01.jpg" class="rounded-circle" alt="">
                                            </div>
                                            <div class="mb-0 ms-2">
                                                <!-- Title -->
                                                <h6 class="mb-0"><a href="#" class="stretched-link">Fasanya Pelumi</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Table data -->
                                    <td class="text-center text-sm-start">
                                        <h6 class="mb-0">15 Nov 2023</h6>
                                    </td>

                                    <!-- Table data -->
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                        </ul>
                                    </td>

                                    <!-- Table data -->
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info-soft mb-0" data-bs-toggle="modal"
                                            data-bs-target="#viewReview">View</a>
                                        <button class="btn btn-sm btn-danger-soft me-1 mb-1 mb-md-0">Delete</button>
                                    </td>
                                </tr>

                                <!-- Table row -->
                                <tr>
                                    <!-- Table data -->
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <!-- Image -->
                                            <div class="avatar avatar-xs mb-2 mb-md-0">
                                                <img src="assets/images/avatar/03.jpg" class="rounded-circle" alt="">
                                            </div>
                                            <div class="mb-0 ms-2">
                                                <!-- Title -->
                                                <h6 class="mb-0"><a href="#" class="stretched-link">Orimolade Elisa</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Table data -->
                                    <td class="text-center text-sm-start">
                                        <h6 class="mb-0">28 Oct 2023</h6>
                                    </td>

                                    <!-- Table data -->
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star-half-alt text-warning"></i></li>
                                        </ul>
                                    </td>
                                    <!-- Table data -->
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info-soft mb-0" data-bs-toggle="modal"
                                            data-bs-target="#viewReview">View</a>
                                        <button class="btn btn-sm btn-danger-soft me-1 mb-1 mb-md-0">Delete</button>
                                    </td>
                                </tr>

                                <!-- Table row -->
                                <tr>
                                    <!-- Table data -->
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <!-- Image -->
                                            <div class="avatar avatar-xs mb-2 mb-md-0">
                                                <img src="assets/images/avatar/04.jpg" class="rounded-circle" alt="">
                                            </div>
                                            <div class="mb-0 ms-2">
                                                <!-- Title -->
                                                <h6 class="mb-0"><a href="#" class="stretched-link">Blessed Emmanuel</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Table data -->
                                    <td class="text-center text-sm-start">
                                        <h6 class="mb-0"><a href="#">12 Oct 2023</a></h6>
                                    </td>

                                    <!-- Table data -->
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star-half-alt text-warning"></i></li>
                                        </ul>
                                    </td>

                                    <!-- Table data -->
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info-soft mb-0" data-bs-toggle="modal"
                                            data-bs-target="#viewReview">View</a>
                                        <button class="btn btn-sm btn-danger-soft me-1 mb-1 mb-md-0">Delete</button>
                                    </td>
                                </tr>

                                <!-- Table row -->
                                <tr>
                                    <!-- Table data -->
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <!-- Image -->
                                            <div class="avatar avatar-xs mb-2 mb-md-0">
                                                <img src="assets/images/avatar/05.jpg" class="rounded-circle" alt="">
                                            </div>
                                            <div class="mb-0 ms-2">
                                                <!-- Title -->
                                                <h6 class="mt-2"><a href="#" class="stretched-link">Agba
                                                        Miller</a></h6>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Table data -->
                                    <td class="text-center text-sm-start">
                                        <h6 class="mb-0"><a href="#">31 Sep 2023</a></h6>
                                    </td>

                                    <!-- Table data -->
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="far fa-star text-warning"></i></li>
                                        </ul>
                                    </td>

                                    <!-- Table data -->
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info-soft mb-0" data-bs-toggle="modal"
                                            data-bs-target="#viewReview">View</a>
                                        <button class="btn btn-sm btn-danger-soft me-1 mb-1 mb-md-0">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <!-- Table body END -->
                        </table>
                    </div>
                    <!-- Table END -->
                </div>
                <!-- Card body END -->

                <!-- Card footer START -->
                <div class="card-footer bg-transparent">
                    <!-- Pagination START -->
                    <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                        <!-- Content -->
                        <p class="mb-0 text-center text-sm-start">Showing 1 to 8 of 20 entries</p>
                        <!-- Pagination -->
                        <nav class="d-flex justify-content-center mb-0" aria-label="navigation">
                            <ul class="pagination pagination-sm pagination-primary-soft mb-0 pb-0">
                                <li class="page-item mb-0"><a class="page-link" href="#" tabindex="-1"><i
                                            class="fas fa-angle-left"></i></a></li>
                                <li class="page-item mb-0"><a class="page-link" href="#">1</a></li>
                                <li class="page-item mb-0 active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item mb-0"><a class="page-link" href="#">3</a></li>
                                <li class="page-item mb-0"><a class="page-link" href="#"><i
                                            class="fas fa-angle-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Pagination END -->
                </div>
                <!-- Card footer END -->
            </div>
        </div> --}}
        <!-- Student review END -->

    </div> <!-- Row END -->
</div>

<div class="modal fade" id="addLecture" tabindex="-1" aria-labelledby="addLectureLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="addLectureLabel">Add Section</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form class="row text-start g-3" method='post' action="{{ route('createsection') }}">@csrf
                    <!-- Course name -->
                    <div class="col-12">
                        <label class="form-label">Section Title <span class="text-danger">*</span></label>
                        <input type="text" name='title' class="form-control" placeholder="Enter section title">
                        <input type="hidden" name='course_id' class="form-control" value="{{ $course->id }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Title Description <span class="text-danger">*</span></label>
                        <input name='description' type="text" class="form-control"
                            placeholder="Enter section description">

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success my-0">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Popup modal for add Section END -->

<!-- Popup modal for add topic START -->
<div class="modal fade" id="gallery" tabindex="-1" aria-labelledby="addTopicLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="addTopicLabel">Add topic</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success my-0">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addTopic" tabindex="-1" aria-labelledby="addTopicLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="addTopicLabel">Add topic</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form class="row text-start g-3" method='post' action='{{ route("createsectionvideo") }}'
                    enctype="multipart/form-data">@csrf
                    <!-- Topic name -->
                    <div class="col-md-12">
                        <label class="form-label">Topic name</label>
                        <input class="form-control" name='title' type="text" placeholder="Enter topic name">
                        <input class="form-control" name='course_id' type="hidden" value="{{ $course->id }}">
                        <input class="form-control" name='section_id' type="hidden" id='section_id' value="">
                    </div>

                    <!-- Video link -->
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Videos/PDFS/DOCS</label>
                        <input class="form-control" multiple='multiple' type="file" name='video[]'
                            placeholder="Enter Video link">
                    </div>
                    <!-- Description -->

                    <!-- Buttons -->
                    <div class="col-6 mt-3">
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <!-- Free button -->
                            <input type="radio" value='0' class="btn-check" name="options" id="option1" checked="">
                            <label class="btn btn-sm btn-light btn-primary-soft-check border-0 m-0"
                                for="option1">Free</label>
                            <!-- Premium button -->
                            <input type="radio" value='1' class="btn-check" name="options" id="option2">
                            <label class="btn btn-sm btn-light btn-primary-soft-check border-0 m-0"
                                for="option2">Premium</label>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success my-0">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Popup modal for add topic END -->

<!-- Popup modal for add faq START -->
<div class="modal fade" id="uploadAss" tabindex="-1" aria-labelledby="uploadAssLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="uploadAssLabel">Add FAQ</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form class="row text-start g-3">
                    <!-- Question -->
                    <div class="col-12">
                        <label class="form-label">Question</label>
                        <input class="form-control" type="text" value="Write a question">
                    </div>
                    <!-- Answer -->
                    <div class="col-12 mt-3">
                        <label class="form-label">Answer</label>
                        <textarea class="form-control" rows="4" value="Write a answer" spellcheck="false"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success my-0">Save topic</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

<!-- Vendors -->
<script src="{{ asset('assets/vendor/choices/js/choices.min.js')}}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js')}}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.js')}}"></script>
<script src="{{ asset('assets/vendor/quill/js/quill.min.js')}}"></script>
<script src="{{ asset('assets/vendor/stepper/js/bs-stepper.min.js')}}"></script>

<!-- Template Functions -->
<script src="{{ asset('assets/js/functions2.js')}}"></script>
<script src="{{ asset('assets/jquery.js')}}"></script>
<script src="{{ asset('assets/sweetalert.js')}}"></script>
<script>
    $(document).ready(function() {

        @if (session('message'))
            			swal('Success!',"{{ session('message') }}",'success');
        			@endif
					@if (session('error'))
            			swal('Error!',"{{ session('error') }}",'error');
        			@endif
        
        $(".add_topic").click(function() {
            id = $(this).data('id')
            $("#section_id").val(id)
        
        })

        $(".upload_ass").click(function() {
            ass_id = $(this).data('id')
            user_id = $(this).data('user_id')
            title =  $(this).data('title')
            section_id =  $(this).data('section')
            $("#upload_ass_id").val(ass_id)
            $("#upload_user_id").val(user_id)
            $("#upload_section_id").val(section_id)
            $("#ass_title").text(title)
            // alert(ass_id, user_id)

           

            // $("#section_id").val(id)
        
        })

        $(".playvideo").click(function() {
            vid = $(this).data('id')
            console.log(vid)
            $("#imagecontent").hide()
            $("#videocontent").show()
            $("#divVideo video").attr('src','/public/sectionvideos/'+vid);
            $("#divVideo video")[0].load();
        })
        $(".playass").click(function() {
            vid = $(this).data('id')
            console.log(vid)
            $("#imagecontent").hide()
            $("#videocontent").show()
            $("#divVideo video").attr('src','/public/assignment_content/'+vid);
            $("#divVideo video")[0].load();
        })
       

    })
</script>
@endsection