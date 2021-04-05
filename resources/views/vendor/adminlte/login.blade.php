	@extends('adminlte::master')

	@section('adminlte_css')
	<link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
	@yield('css')
	@stop

	@section('body_class', 'login-page')

	@if (session()->has('Success'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Alert!</h4>
		<strong>{{ session('Success') }}</strong>
	</div>
	@endif

	@section('body')
	<div id="overlay" style="background-color: #FFFFFF; z-index: 999;
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		display: none;">
		<img style="margin-left: auto;  margin-right: auto; display:block" src="{{asset('css/images/LogoWhite.png')}}" alt="">
		<h3 style="text-align: center;"><strong style="color: red;">{{__('Error')}}:</strong> {{__('You can only access this software using the following browsers: Google Chrome, Firefox')}}.</h3>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-md-4">
				<div style=" border-radius: 15px; margin-top: 150px " class="box box-default">
					<div class="box-header with-border">
						<i class="fa fa-warning"></i>
						<h3 class="box-title">Alerts</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="alert alert-warning alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-info"></i>{{__('Beta')}}!</h4>
							{{__('This editor is in beta testing, bugs can happen. We are working to implement new features and fix bugs, if you have any problem please contact us through the help menu.')}}
						</div>
						<div class="alert alert-warning alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-chrome"></i>Use {{__('Google Chrome')}}!</h4>
							{{__('We strongly recommend using google chrome to run the editor, as we are not still able to run enough tests in other browsers.')}}
						</div>
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-money"></i> {{__('Donate')}}</h4>
							<h4>{{__('Hello! If the editor was helpful to you, please consider making a small donation via PayPal. Thank you!')}}</h4>
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
								<input type="hidden" name="cmd" value="_s-xclick" />
								<input type="hidden" name="hosted_button_id" value="WE94D2BSERZNN" />
								<input class="center-image" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
								<img alt="" border="0" src="https://www.paypal.com/en_BR/i/scr/pixel.gif" width="1" height="1" />
							</form>
						</div>
					</div>
					<!-- /.box-body -->
				</div>

			</div>
			<div class="col-md-4">
				<div class="login-box">
					<div class="login-logo">
						<img class="img-responsive img" id="login-image" src="{{asset('css/images/LogoGreen.png')}}" alt="onto4all-logo" srcset="">
					</div>
					<!-- /.login-logo -->
					<div class="login-box-body">

						<p class="login-box-msg">{{ __('Sign in to start your session') }}</p>
						<form data-grecaptcha-action="message" action="{{ route('login', app()->getLocale()) }}" method="post">
							{!! csrf_field() !!}

							<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
								<input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}">
								<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
								@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
								<input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}">
								<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								@if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
								@endif
							</div>
							<div class="row">
								<div class="col-xs-8">
									<div class="checkbox icheck">
										<label>
											<input type="checkbox" name="remember"> {{ __('Remember Me')}}
										</label>
									</div>
								</div>
								<!-- /.col -->
								<div class="col-xs-4">
									<button style="background-color: #00A65A" type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Sign In') }}</button>
								</div>
								<!-- /.col -->

							</div>
						</form>

						<div class="auth-links">
							<a href="{{ route('password.request', app()->getLocale()) }}" class="text-center">{{ __('Forgot Your Password?')}}</a>
							<br>
							@if (config('adminlte.register_url', 'register'))
							<a href="{{route('register', app()->getLocale())}}" class="text-center">{{__('Register')}}</a>
							@endif
						</div>
						<br>
						<div class="row">
							<h4 style="text-align: center"><strong>Version</strong> Beta 2.5.1</h4>
						</div>
					</div>
					<!-- /.login-box-body -->
				</div><!-- /.login-box -->
			</div>
		</div>
	</div>


	@stop


	@section('adminlte_js')
	<script src="{{asset('js/Browser.js')}}"></script>
	<script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
	<script>
		$(function() {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
		});
	</script>
	@yield('js')
	@stop
