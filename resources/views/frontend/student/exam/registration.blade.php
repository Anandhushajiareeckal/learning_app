@extends('frontend.layouts.app')

@section('content')
<div class="bg-page">

    <header class="page-banner-header gradient-bg position-relative">
        <div class="section-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <div class="page-banner-content text-center">
                            <h3 class="page-banner-heading text-white pb-15">Scholarship</h3>

                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item font-14"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item font-14 active" aria-current="page"> Scholarship</li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <section class="contact-page-area section-t-space">
        <div class="container">
            <div class="row">

                <!-- <div class="col-md-6 col-lg-5 bg-white contact-page-left-side">
                    <div class="contact-page-left-side-wrap">
                        <h5 class="contact-form-title font-24 font-semi-bold">Get in Touch</h5>

                        <div class="contact-info-item d-flex align-items-center">
                            <div class="flex-shrink-0 contact-icon-img-wrap">
                                <img src="frontend/assets/img/icons-svg/contact-icon-1.png" alt="feature">
                            </div>
                            <div class="flex-grow-1 ms-3 contact-info-content">
                                <p>32 Yaool, myself down around dupal the street, London</p>
                            </div>
                        </div>


                        <div class="contact-info-item d-flex align-items-center">
                            <div class="flex-shrink-0 contact-icon-img-wrap">
                                <img src="frontend/assets/img/icons-svg/contact-icon-2.png" alt="feature">
                            </div>
                            <div class="flex-grow-1 ms-3 contact-info-content">
                                <p><a href="cdn-cgi/l/email-protection.html" class="__cf_email__"
                                        data-cfemail="224f434b4e624e4f5158434b0c414d0c5749">[email&#160;protected]</a>
                                </p>
                                <p><a href="cdn-cgi/l/email-protection.html" class="__cf_email__"
                                        data-cfemail="640d0a020b240809051e050d0d0a0a01164a070b4a110f">[email&#160;protected]</a>
                                </p>
                            </div>
                        </div>


                        <div class="contact-info-item d-flex align-items-center">
                            <div class="flex-shrink-0 contact-icon-img-wrap">
                                <img src="frontend/assets/img/icons-svg/contact-icon-3.png" alt="feature">
                            </div>
                            <div class="flex-grow-1 ms-3 contact-info-content">
                                <p>328-456-07875</p>
                                <p>128-456-07875</p>
                            </div>
                        </div>

                        <div class="contact-bottom-content">
                            <p class="color-gray mt-3">Strikes the upper surface of the impenetrable foliage of my
                                trees, and but a few stray gleams steal about the human. It might take 6 -12 hour to
                                replay</p>
                        </div>
                    </div>
                </div> -->


                <div class="col-12 bg-white contact-page-right">
                    <div class="contact-form-area">
                        <h5 class="contact-form-title font-24 font-semi-bold">Register here for scholarship!</h5>
                        <form id="contact-form" method="POST" action="/student/scholarships_registration_store">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-30">
                                    <input type="text" name="name" class="form-control" id="inputName"
                                        placeholder="Student Name" required >
                                </div>
                                {{-- <div class="col-md-6 mb-30">
                                    <input type="email" class="form-control" id="inputEmail"
                                        placeholder="Email">
                                </div> --}}
                                <div class="col-md-6 mb-30">
                                    <input type="text" class="form-control" id="inputName"
                                        placeholder="Whatsapp Number / Mobile number" name="number" required>
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="col-md-6 mb-30">
                                    <input type="text" class="form-control" id="inputEmail"
                                        placeholder="Alternative Number" name="parent_numb" required>
                                </div>
                                <div class="col-md-6 mb-30">
                                    <select id="inputState" class="form-select contact_us_issue_id" name="sex" required>
                                        <option value>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female"> Female</option>
                                        <option value="Other"> Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-6 mb-30">
                                    <input type="text" class="form-control" id="inputName"
                                        placeholder="Age" name="age" required>
                                </div>
                                <div class="col-md-6 mb-30">
                                    <select id="inputState" name="scholarship" class="form-select contact_us_issue_id">
                                        <option value>Select Scholarship</option>
                                        @foreach ($scholarship as $item)
                                            <option value="{{$item->id}}">{{$item->heading}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-30">
                                    <textarea name="adress" class="form-control message" placeholder="Adderess" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <a href="/scholarship-registration" class=" theme-button1 theme-button3 w-100 font-15 fw-bold submitContactUs" >Reset</a>
                                </div>
                                <div class="col-2">
                                    <button type="submit"  class="theme-btn theme-button1 theme-button3 w-100 font-15 fw-bold ">Submit</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>

            </div>

            <!-- <div class="row google-map-area section-t-space">
                <div class="col-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1839.0179632416985!2d89.5538504127622!3d22.801132631062536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff8f2b1098bf95%3A0xbce09c90b98f8380!2sJust%20Orders%20Khulna!5e0!3m2!1sen!2sbd!4v1636005141952!5m2!1sen!2sbd"
                        style="border:0;" allowfullscreen loading="lazy"></iframe>
                </div>
            </div> -->

        </div>
    </section>

</div>
</section>
@endsection