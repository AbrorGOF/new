<!DOCTYPE html>
<html lang="en">
<head>

    <title>iMedic</title>
    <!--

    Template 2098 Health

    http://www.tooplate.com/view/2098-health

    -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Tooplate">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href="{{ asset('css/template/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template/tooplate-style.css') }}" rel="stylesheet">


</head>
<body id="top" data-spy="scroll"  data-offset="50">

<!-- PRE LOADER -->
<section class="preloader">
    <div class="spinner">

        <span class="spinner-rotate"></span>

    </div>
</section>


<!-- HEADER -->
<header>
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-sm-5">
                <p>Xamshiralarni malaka oshirish markazi</p>
            </div>

            <div class="col-md-8 col-sm-7 text-align-right">
                <span class="phone-icon"><i class="fa fa-phone"></i> 871-214-4731</span>
                <span class="date-icon"><i class="fa fa-calendar"></i> 09:00 dan - 18:00 gacha (Dushanba-Juma)</span>
                {{-- <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="#">info@imedic.uz</a></span> --}}
            </div>

        </div>
    </div>
</header>


<!-- MENU -->
<section class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>

            <!-- lOGO TEXT HERE -->
            <a href="/welcome" class="navbar-brand"><i class="fa fa-info"></i> Medic</a>
        </div>

        <!-- MENU LINKS -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                {{-- <li><a href="#top" class="smoothScroll">Home</a></li>
                <li><a href="#about" class="smoothScroll">About Us</a></li>
                <li><a href="#team" class="smoothScroll">Doctors</a></li>
                <li><a href="#news" class="smoothScroll">News</a></li>
                <li><a href="#google-map" class="smoothScroll">Contact</a></li> --}}
                <li class="appointment-btn"><a href="{{ route('login') }}">Kirish</a></li>
                <li class="appointment-btn"><a href="/auth/register">Ro'yxatdan o'tish</a></li>
            </ul>
        </div>

    </div>
</section>


<!-- HOME -->
<section id="home" class="slider" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="owl-carousel owl-theme">
                <div class="item item-first">
                    <div class="caption">
                        <div class="col-md-offset-1 col-md-10">
                            <h3>Ma'lakangizni oshiring</h3>
                            <h1>HAMSHIRALIK ISHI FAOLIYATINI BOSHLANG</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="about-info">
                    <h2 class="wow fadeInUp " data-wow-delay="0.6s"><span style="color: #a5c422;"><i class="fa fa-info"></i> Medic</span> ga <br> Hush Kelibsiz</h2>
                    <div class="wow fadeInUp" data-wow-delay="0.8s">
                        <p>Asosiy vazifamiz – tibbiyot sohasini yuqori samara bilan ishlaydigan, chinakam xalqchil tizimga aylantirishdan iborat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- <!-- TEAM --> --}}
{{-- <section id="team" data-stellar-background-ratio="1">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <div class="about-info">
                    <h2 class="wow fadeInUp" data-wow-delay="0.1s">Bizning malakali professorlar</h2>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-4 col-sm-6">
                <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                    <img src="{{asset('/images/template/team-image1.jpg')}}" class="img-responsive" alt="">

                    <div class="team-info">
                        <h3>Abror Azimov</h3>
                        <p>Bosh jarrox</p>
                        <div class="team-contact-info">
                            <p><i class="fa fa-phone"></i> 899-518-1521</p>
                            <p><i class="fa fa-envelope-o"></i> <a href="#">abror.azimov@imedic.uz</a></p>
                        </div>
                        <ul class="social-icon">
                            <li><a href="#" class="fa fa-linkedin-square"></a></li>
                            <li><a href="#" class="fa fa-envelope-o"></a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="team-thumb wow fadeInUp" data-wow-delay="0.4s">
                    <img src="{{asset('/images/template/team-image2.jpg')}}" class="img-responsive" alt="">

                    <div class="team-info">
                        <h3>Otabek Raxmonov</h3>
                        <p>Bosh dietolog</p>
                        <div class="team-contact-info">
                            <p><i class="fa fa-phone"></i> 890-070-0170</p>
                            <p><i class="fa fa-envelope-o"></i> <a href="#">otabek.raxmonov@imedic.uz</a></p>
                        </div>
                        <ul class="social-icon">
                            <li><a href="#" class="fa fa-facebook-square"></a></li>
                            <li><a href="#" class="fa fa-envelope-o"></a></li>
                            <li><a href="#" class="fa fa-flickr"></a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="team-thumb wow fadeInUp" data-wow-delay="0.6s">
                    <img src="{{asset('/images/template/team-image3.jpg')}} " class="img-responsive" alt="">

                    <div class="team-info">
                        <h3>Latifaxon Abdullayeva</h3>
                        <p>Bosh xamshira</p>
                        <div class="team-contact-info">
                            <p><i class="fa fa-phone"></i> 899-040-0140</p>
                            <p><i class="fa fa-envelope-o"></i> <a href="#">latifaxon.abdullayeva@imedic.uz</a></p>
                        </div>
                        <ul class="social-icon">
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-envelope-o"></a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section> --}}


<!-- NEWS -->
<section id="news" data-stellar-background-ratio="2.5">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <!-- SECTION TITLE -->
                <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                    <h2>Mustaqil hamshira bo'lish</h2>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <!-- NEWS THUMB -->
                <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                    <div class="news-info">
                        <span>1-qadam</span>
                        <h3><a href="#">Sertifikat</a></h3>
                        <p>Viloyat Malaka oshirish markazlarida malaka oshirish orqali olinadi.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <!-- NEWS THUMB -->
                <div class="news-thumb wow fadeInUp" data-wow-delay="0.6s">
                    <div class="news-info">
                        <span>2-qadam</span>
                        <h3><a href="#">Guvohnoma</a></h3>
                        <p>Soliq to‘lovchining shaxsiy kabineti orqali yoxud davlat
                            soliq xizmati organiga kelgan holda ro‘yxatdan o‘tgan holda (QR-kod) ega bo‘lgan ma’lumotnoma rasmiylashtiriladi.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6" >
                <!-- NEWS THUMB -->
                <div class="news-thumb wow fadeInUp" data-wow-delay="0.8s" style="height: 100%">
                    <div class="news-info">
                        <span>3-qadam</span>
                        <h3><a href="news-detail.html">Profil</a></h3>
                        <p>Shu saytda ro'yxatdan o'tish orqali amalga oshiriladi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- <!-- MAKE AN APPOINTMENT -->
<section id="appointment" data-stellar-background-ratio="3">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <img src="images/appointment-image.jpg" class="img-responsive" alt="">
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- CONTACT FORM HERE -->
                <form id="appointment-form" role="form" method="post" action="#">

                    <!-- SECTION TITLE -->
                    <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                        <h2>Ariza qoldiring</h2>
                    </div>

                    <div class="wow fadeInUp" data-wow-delay="0.8s">
                        <div class="col-md-6 col-sm-6">
                            <label for="name">Ism</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="To'liq ism sharifingiz">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label for="date">Tashrif vaqti</label>
                            <input type="date" name="date" value="" class="form-control">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label for="select">Yo'nalish</label>
                            <select class="form-control">
                                <option>Jarroxlik</option>
                                <option>Kardiologiya</option>
                                <option>Stomatologiya</option>
                                <option>Dietologiya</option>
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <label for="telephone">Telefon</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Telefon raqamingiz">
                            <label for="Message">Qo'shimcha ma'lumot</label>
                            <textarea class="form-control" rows="5" id="message" name="message" placeholder=""></textarea>
                            <button type="submit" class="form-control" id="cf-submit" name="submit">Yuborish</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section> --}}


<!-- GOOGLE MAP -->
<section id="google-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2994.428690077023!2d69.18128531567007!3d41.36477000535938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8e8775f4080d%3A0xba44991cc82e4503!2z0JzQtdC00LjRhtC40L3RgdC60LjQuSDQs9C-0YDQvtC00L7Qug!5e0!3m2!1sru!2s!4v1643721722462!5m2!1sru!2s" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen loading="lazy"></iframe>
</section>


<!-- FOOTER -->
<footer data-stellar-background-ratio="5">
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-sm-4">
                <div class="footer-thumb">
                    <h4 class="wow fadeInUp" data-wow-delay="0.4s">Manzil</h4>
                    <p>Toshkent shahar, Olmazor tumani, 2-chi Shifokorlar tor ko'chasi, 14.</p>

                    <div class="contact-info">
                        <p><i class="fa fa-phone"></i> 871-214-4731</p>
                        {{-- <p><i class="fa fa-envelope-o"></i> <a href="#">info@imedic.uz</a></p> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="footer-thumb">
                    <div class="opening-hours">
                        <h4 class="wow fadeInUp" data-wow-delay="0.4s">Qa'bul vaqtlari</h4>
                        <p>Dushanba - Juma <span>09:00 dan - 18:00 gacha</span></p>

                    </div>

                    <ul class="social-icon">
                        <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-instagram"></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 border-top">
                <div class="col-md-4 col-sm-6">
                    <div class="copyright-text">
                        <p>Copyright &copy; 2022 iMedic


                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="footer-link">
                        <a href="#">Laboratoriya</a>
                        <a href="#">Yo'nalishlar</a>
                        <a href="#">Kafolatlash</a>
                        <a href="#">Ish o'rinlari</a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-2 text-align-center">
                    <div class="angle-up-btn">
                        <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>

<!-- SCRIPTS -->

<script src="{{asset('js/template/jquery.js')}}"></script>
<script src="{{asset('js/template/bootstrap.min.js')}}"></script>
<script src="{{asset('js/template/jquery.sticky.js')}}"></script>
<script src="{{asset('js/template/jquery.stellar.min.js')}}"></script>
<script src="{{asset('js/template/wow.min.js')}}"></script>
<script src="{{asset('js/template/smoothscroll.js')}}"></script>
<script src="{{asset('js/template/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/template/custom.js')}}"></script>

@yield('extra-js')



</body>
</html>
