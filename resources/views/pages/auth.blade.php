@extends('layout.template')

@section('title')
    Log In / Register
@endsection

@section('main')
    <section id="login" class="three">
        <div class="container">

            <header>
                <h2>Log In</h2>
            </header>

            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="1u"></div>
                    <div class="5u">
                        <input type="text" name="usernamel" id="usernamel" placeholder="Username" />
                    </div>
                    <div class="5u">
                        <input type="password" name="passwordl" id="passwordl" placeholder="Password" />
                    </div>
                    <div class="1u"></div>
                </div>
                <div class="row">
                    <div class="12u">
                        <input type="submit" value="Log In" />
                    </div>
                </div>
            </form>

            <p>If you have forgotten you password, please <a href="#" id="forget-password-button" title="Reset Password">click here</a>.</p>

            <p>If you don't have an account, you can register <a href="#" data-anchor="#register" class="anchor">below</a>.</p>

        </div>
    </section>
    <section id="register" class="two">
        <div class="container">

            <header>
                <h2>Register</h2>
            </header>

            <form method="post" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="1u"></div>
                    <div class="5u">
                        <input type="text" name="name" id="name" placeholder="First Name" onkeyup="authRegisterName();" />
                        <label>First letter must be capitalized.</label>
                    </div>
                    <div class="5u">
                        <input type="text" name="surname" id="surname" placeholder="Last Name" onkeyup="authRegisterSurname();" />
                        <label>First letter must be capitalized.</label>
                    </div>
                    <div class="1u"></div>
                </div>
                <div class="row">
                    <div class="1u"></div>
                    <div class="5u">
                        <input type="password" name="passwordr" id="passwordr" placeholder="Password" onkeyup="authRegisterPassword();" />
                        <label>Password must to be at least 6 characters and to have one number.</label>
                    </div>
                    <div class="5u">
                        <input type="password" name="passwordc" id="passwordc" placeholder="Confirm Password" onkeyup="authRegisterPasswordConfirm();" />
                    </div>
                    <div class="1u"></div>
                </div>
                <div class="row">
                    <div class="1u"></div>
                    <div class="5u">
                        <input type="text" name="usernamer" id="usernamer" placeholder="Username" onkeyup="authRegisterUsername();" />
                        <label>Username must have between 3 and 25 characters.</label>
                    </div>
                    <div class="5u">
                        <input type="text" name="email" id="email" placeholder="E-Mail" onkeyup="authRegisterEmail();" />
                    </div>
                    <div class="1u"></div>
                </div>
                <div class="row">
                    <div class="12u">
                        <input type="submit" value="Register" />
                    </div>
                </div>
            </form>

        </div>
    </section>
@endsection