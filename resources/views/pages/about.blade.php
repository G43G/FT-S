@extends('layout.template')

@section('title')
    About Me
@endsection

@section('main')
    <section id="about" class="three">
        <div class="container">
            <div class="info-holder">
                <div class="about-image">
                    <img src="{{ asset('/img/main/about-me.jpg') }}" alt="about-me-image" />
                    <p class="documentation-link">Documentation for this project can be found <a href="{{ asset('/about/download') }}" title="Project Documentation">here</a>.</p>
                </div>
                <div class="about-info">
                    <p>Hi, my name is Bogdan Matorkić (student number 30/13) and I am
                        a student on ICT College of Applied Studies in Belgrade, Internet
                        Technologies module. I am on extended year and have only my thesis
                        left. I am also currently working as WordPress developer at Qode
                        Themes for almost two years. I am more comfortable doing back and
                        programming, but I also have knowledge in front-end and I am always
                        eager to learn something new.<br/><br/>
                        You can contact me through social networks or by sending me a message <a href="#" data-anchor="#contact" class="anchor">below</a>.
                    </p>
                </div>
            </div>
            <div class="about-social-holder">
                <a href="https://www.facebook.com/bogdan.matorkic" class="facebook" title="Facebook Profile" target="_blank"><i class="icon fa-facebook-square"></i></a>
                <a href="https://mobile.twitter.com/43GuitarGod" class="twitter" title="Twitter Profile" target="_blank"><i class="icon fa-twitter-square"></i></a>
                <a href="https://www.instagram.com/43guitargod/" class="instagram" title="Instagram Profile" target="_blank"><i class="icon fa-instagram"></i></a>
                <a href="https://www.linkedin.com/in/bogdan-matorkic-992317140/" class="linkedin" title="LinkedIn Profile" target="_blank"><i class="icon fa-linkedin-square"></i></a>
            </div>
        </div>
    </section>
    <section id="contact" class="four">
        <div class="container">
            <form method="POST" action="{{ asset('/about/send-mail') }}">
                {{ csrf_field() }}
                <div class="row 50%">
                    <div class="6u"><input type="text" name="contact-name" id="contact-name" placeholder="Name" /></div>
                    <div class="6u"><input type="text" name="contact-email" id="contact-email" placeholder="Email" /></div>
                </div>
                <div class="row 50%">
                    <div class="12u">
                        <textarea name="contact-message" id="contact-message" placeholder="Message"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="12u">
                        <input type="submit" value="Send Message" name="send-contact-message" id="send-contact-message" />
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection