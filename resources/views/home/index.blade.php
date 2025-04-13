<!DOCTYPE HTML>
<html>

<head>
    <title>Csm SmartSchool</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="icon" href="{{ asset('img/books.png') }}" />
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.14/css/mdb.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css' />
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- //Custom Theme files -->
    <!--webfonts-->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <!--//webfonts-->
</head>

<body>
        
    <!-- header -->
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="index.php">
                    Csm SmartSchool
                </a>
                <button class="navbar-toggler ml-lg-auto ml-sm-5" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item mr-3">
                            <a class="nav-link scroll" href="#about">about</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll" href="{{ route('home.index0') }}" data-target="#modalLRForm" data-toggle="modal">Login/Signup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll" href="#contact">contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

   
    <!-- banner -->
    <div class="banner" id="home">
        <div class="container">
            <div class="banner-text">
                <div class="slider-info text-right">
                    <h1 class="text-uppercase">Complexe <br> Scolaire <br> Multinacional.</h1>
                    <p class="text-white">Are you a Singer?...Upload Your Music here and get featured.</p>
                    <a class="btn btn-agile  mt-4 scroll" href="#about" role="button">read more</a>
                </div>
            </div>
        </div>
    </div>
    <!-- //banner -->

    <!-- about-->
    <section class="wthree-row" id="about">
        <div class="row justify-content-center align-items-center no-gutters abbot-main">
            <div class="col-lg-6 p-0">
                <img src="{{ asset('img/retrato.jpg') }}" class="img-fluid" alt="" />
            </div>
            <div class="col-lg-6 abbot-right px-md-5 py-lg-0 py-3">
                <div class="card">
                    <div class="card-body px-lg-5">
                        <h3 class="stat-title card-title align-self-center mb-sm-5 mb-3">musical world<br> get addicted to music</h3>
                        <span class="w3-line"></span>
                        <p class="card-text align-self-center my-4 text-white">
                            Are you a singer?...But afraid to sing in front of a huge crowd. Then you are in the right place. Upload your songs to musical world and let the people listen to your songs and rate them.
                        </p>
                        <p class="card-text align-self-center mb-5 text-white">Be part of the musical world. Upload your songs and get featured by great musicians.</p>
                        <a href="#more_info" class="btn btn-agile abt_card_btn scroll">Know More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //about -->

    <!-- contact -->
    <div class="w3-contact py-5" id="contact">
        <div class="container">
            <div class="row contact-form pt-md-5">
                <!-- contact details -->
                <div class="col-lg-6 contact-bottom d-flex flex-column contact-right-w3ls">
                    <h5>get in touch</h5>
                    <div class="fv3-contact">
                        <div class="row">
                            <div class="col-2">
                                <span class="fas fa-envelope-open"></span>
                            </div>
                            <div class="col-10">
                                <h6>email</h6>
                                <p>
                                    <a href="mailto:example@email.com" class="text-dark">admin@musicalworld.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="fv3-contact my-4">
                        <div class="row">
                            <div class="col-2">
                                <span class="fas fa-phone-volume"></span>
                            </div>
                            <div class="col-10">
                                <h6>phone</h6>
                                <p>+91 7899496873</p>
                            </div>
                        </div>
                    </div>
                    <div class="fv3-contact">
                        <div class="row">
                            <div class="col-2">
                                <span class="fas fa-home"></span>
                            </div>
                            <div class="col-10">
                                <h6>address</h6>
                                <p>DSI Labz | Adyar Mangalore</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wthree-form-left my-lg-0 mt-5">
                    <h5>send us a mail</h5>
                    <div class="contact-top1">
                        <form action="#" method="get" class="contact-wthree">
                            <div class="form-group d-flex">
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="Name" name="email" required=""/>
                            </div>
                            <div class="form-group d-flex">
                                <label>Email</label>
                                <input class="form-control" type="email" placeholder="email" name="email" required=""/>
                            </div>
                            <div class="form-group d-flex">
                                <label>Phone</label>
                                <input class="form-control" type="text" placeholder="phone number" name="email" required=""/>
                            </div>
                            <div class="form-group d-flex">
                                <label>Message</label>
                                <textarea class="form-control" rows="5" id="contactcomment" placeholder="Your message" required></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-agile btn-block w-50">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //contact -->

    <!-- copyright -->
    <div class="cpy-right text-center">
        <p>© 2025 complexe scolaire multinacional. All rights reserved</p>
    </div>
    <!-- //copyright -->

    <!-- Modal and Scripts -->
    <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script> <!-- Adicionando o Popper.js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script> <!-- Certifique-se de usar o bootstrap.min.js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.14/js/mdb.min.js"></script>
    <script src="{{ asset('js/move-top.js') }}"></script>
    <script src="{{ asset('js/easing.js') }}"></script>

    <script>
        $(document).ready(function () {
            $(".scroll ").click(function (event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });

            // Inicializar o modal
            $('#modalLRForm').modal();

            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>
    <script src="{{ asset('js/SmoothScroll.min.js') }}"></script>

    <!-- Modal Login/Signup -->
    <div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <div class="modal-content">

                <div class="modal-c-tabs">

                    <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab">
                                <i class="fa fa-user mr-1"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#panel8" role="tab">
                                <i class="fa fa-user-plus mr-1"></i> Sign up</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Login Panel -->
                        <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
                            <div class="modal-body mb-1">
                                <div class="md-form form-sm mb-4">
                                    <i class="fa fa-envelope prefix"></i>
                                    <input type="email" id="modalLRInput10" class="form-control form-control-sm validate">
                                    <label for="modalLRInput10">Your email</label>
                                </div>

                                <div class="md-form form-sm mb-4">
                                    <i class="fa fa-lock prefix"></i>
                                    <input type="password" id="modalLRInput11" class="form-control form-control-sm validate">
                                    <label for="modalLRInput11">Your password</label>
                                </div>

                                <div class="text-center mt-2">
                                    <button class="btn btn-info">Log in</button>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="options text-center text-md-right mt-1">
                                    <p>Not a member? <a href="#" class="blue-text">Sign Up</a></p>
                                    <p>Forgot <a href="#" class="blue-text">Password?</a></p>
                                </div>
                            </div>
                        </div>

                        <!-- Sign Up Panel -->
                        <div class="tab-pane fade" id="panel8" role="tabpanel">
                            <div class="modal-body">
                                <div class="md-form form-sm mb-4">
                                    <i class="fa fa-user prefix"></i>
                                    <input type="text" id="modalLRInput12" class="form-control form-control-sm validate">
                                    <label for="modalLRInput12">Your name</label>
                                </div>

                                <div class="md-form form-sm mb-4">
                                    <i class="fa fa-envelope prefix"></i>
                                    <input type="email" id="modalLRInput13" class="form-control form-control-sm validate">
                                    <label for="modalLRInput13">Your email</label>
                                </div>

                                <div class="md-form form-sm mb-4">
                                    <i class="fa fa-lock prefix"></i>
                                    <input type="password" id="modalLRInput14" class="form-control form-control-sm validate">
                                    <label for="modalLRInput14">Your password</label>
                                </div>

                                <div class="text-center form-sm mt-2">
                                    <button class="btn btn-deep-orange">Sign up</button>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="options text-right">
                                    <p>Already have an account? <a href="#" class="blue-text">Log In</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>

</html>
