<div class="aiz-user-sidenav-wrap pt-4 position-relative z-1 shadow-sm">
    <div class="absolute-top-right d-xl-none">
        <button class="btn btn-sm p-2" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav"
            data-same=".mobile-side-nav-thumb">
            <i class="las la-times la-2x"></i>
        </button>
    </div>
    <div class="absolute-top-left d-xl-none">
        <a class="btn btn-sm p-2" href="">
            <i class="las la-sign-out-alt la-2x"></i>
        </a>
    </div>
    @php
    $id = Auth::user()->id;
    $userdata = App\Models\User::find($id);
    @endphp
    <div class="aiz-user-sidenav rounded overflow-hidden  c-scrollbar-light">
        <div class="px-4 text-center mb-4">
            <span class="avatar avatar-md mb-3">
                <img src="{{ (!empty($userdata -> profile_photo_path)) ? url('uploads/user/' . $userdata -> profile_photo_path) : url('uploads/avatar.jpg')}}">
            </span>

            <h4 class="h5 fw-600">{{ $userdata -> name }}</h4>
        </div>

        <div class="sidemnenu mb-3">
            <ul class="aiz-side-nav-list metismenu" data-toggle="aiz-side-menu">

                <li class="aiz-side-nav-item mm-active">
                    <a href="https://demo.activeitzone.com/ecommerce/dashboard"
                        class="aiz-side-nav-link active" aria-expanded="true">
                        <i class="las la-home aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Dashboard</span>
                    </a>
                </li>


                <li class="aiz-side-nav-item">
                    <a href="https://demo.activeitzone.com/ecommerce/purchase_history"
                        class="aiz-side-nav-link ">
                        <i class="las la-file-alt aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Purchase History</span>
                        <span class="badge badge-inline badge-success">New</span> </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="https://demo.activeitzone.com/ecommerce/digital_purchase_history"
                        class="aiz-side-nav-link ">
                        <i class="las la-download aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Downloads</span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="https://demo.activeitzone.com/ecommerce/sent-refund-request"
                        class="aiz-side-nav-link ">
                        <i class="las la-backward aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Sent Refund Request</span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="https://demo.activeitzone.com/ecommerce/wishlists" class="aiz-side-nav-link ">
                        <i class="la la-heart-o aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Wishlist</span>
                    </a>
                </li>


                <li class="aiz-side-nav-item">
                    <a href="https://demo.activeitzone.com/ecommerce/customer_products"
                        class="aiz-side-nav-link ">
                        <i class="lab la-sketch aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Classified Products</span>
                    </a>
                </li>


                <li class="aiz-side-nav-item">
                    <a href="https://demo.activeitzone.com/ecommerce/conversations"
                        class="aiz-side-nav-link ">
                        <i class="las la-comment aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Conversations</span>
                    </a>
                </li>


                <li class="aiz-side-nav-item">
                    <a href="https://demo.activeitzone.com/ecommerce/wallet" class="aiz-side-nav-link ">
                        <i class="las la-dollar-sign aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">My Wallet</span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="https://demo.activeitzone.com/ecommerce/earning-points"
                        class="aiz-side-nav-link ">
                        <i class="las la-dollar-sign aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Earning Points</span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="javascript:void(0);" class="aiz-side-nav-link ">
                        <i class="las la-dollar-sign aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Affiliate</span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2 mm-collapse">
                        <li class="aiz-side-nav-item">
                            <a href="https://demo.activeitzone.com/ecommerce/affiliate/user"
                                class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Affiliate System</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="https://demo.activeitzone.com/ecommerce/affiliate/user/payment_history"
                                class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Payment History</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="https://demo.activeitzone.com/ecommerce/affiliate/user/withdraw_request_history"
                                class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Withdraw Request history</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="aiz-side-nav-item">
                    <a href="https://demo.activeitzone.com/ecommerce/support_ticket"
                        class="aiz-side-nav-link ">
                        <i class="las la-atom aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Support Ticket</span>
                        <span class="badge badge-inline badge-success">1</span> </a>
                </li>
                <li class="aiz-side-nav-item">
                    <a href="{{ route('user.profile.edit') }}" class="aiz-side-nav-link ">
                        <i class="las la-user aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Manage Profile</span>
                    </a>
                </li>

            </ul>
        </div>
        <div>
            <a href="https://demo.activeitzone.com/ecommerce/shops/create"
                class="btn btn-block btn-soft-primary rounded-0">
                Be a Seller
            </a>
        </div>

    </div>
</div>
