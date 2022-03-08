<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kanggotan</title>
    
    @include('public.linkcss')
    @yield('single-page-css')    
    <link rel="stylesheet" href="{{asset('css/essentials.css')}}">
</head>


<body>
    <div id="loading" class="loading-overlay hidden">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <div>
                <div class="half-circle-spinner mx-auto">
                    <div class="circle circle-1"></div>
                    <div class="circle circle-2"></div>
                  </div>
                  <div class="py-2">
                      <span class="text-white fw-bold">
                        Please wait y ges y
                    </span>
                    </div>
            </div>
         
        </div>
    </div>
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="row no-gutter">
                    <div class="col-6 d-none d-md-block">
                        <img src="https://images.unsplash.com/photo-1566888596782-c7f41cc184c5?ixlib=rb-1.2.1&auto=format&fit=crop&w=2134&q=80" class="img-fluid" style="min-height:100%;" />
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="d-flex justify-content-between pt-3 pe-3">
                            <div></div>
                            <div class="close">
                                <span class="close" data-bs-dismiss="modal" aria-label="close">
                                    <i class="fa-regular fa-x"></i>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column form">
                            <div class="pt-1 ps-2">
                                <span class="text-dark h3">Sign In</span>
                            </div>
                        </div>
                        <form id="signin-form" method="post">
                            <div class="pt-3 px-2 pe-4 py-2 mt-5">
                                <div class="form-group mb-0 py-2">
                                    <label for="email-form" class="fw-bold">Email</label>
                                    <input type="email" class="form-control form-control-lg" name="email" id="email-form" placeholder="Email">
                                </div>
                                <div class="form-group mb-0 py-2">
                                    <label for="password-form" class="fw-bold">Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password" id="password-form" placeholder="Password">
                                </div>
                                <div class="py-2">
                                    <button type="submit" class="form-control btn btn-submit text-white rounded submit px-3" >Sign In</button>
                                </div>
                                <div class="form-group d-md-flex d-flex justify-content-between">
                                    <div class="w-50 text-start">
                                        <input type="checkbox" id="remember-me" checked="true">
                                        <label class="checkbox-wrap checkbox-primary mb-0" for="remember-me">Remember Me</label>
                                    </div>
                                    <div class="w-50 text-end">
                                        <a href="#">Forgot Password?</a>
                                    </div>
                                </div>
                                <p class="text-center py-3">Not a member? <a data-toggle="tab" href="#signup">Contact Admin</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('public.header')
    
    @yield('content')
    
    @include('public.footer')
    @include('public.scriptjs')
    @yield('single-page-js')
</body>
</html>