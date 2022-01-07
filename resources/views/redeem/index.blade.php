@extends('partials.header_front')

 <div class="site clearfix">

            <div class="main-content__body container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="landing-container">

                            <div class="landing-heading">
                                <h1>Redeem Voucher</h1>
                                <p></p>

                            </div>

                            <div class="card card-form">
                                <div class="card-header">
                                        <div class="card-header__inner">
                                            <div class="car-header__left">
                                                <h5 class="card-title">[Voucher Title]</h5>
                                                <h5 class="card-subtitle">[Voucher Merchant]</h5>
                                            </div>
                                            <div class="card-header__right">
                                               
                                            </div>
                                        </div>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ getImage($redeemInformation->campaign_voucher_main_image_url ,'voucher', 'original') }}" alt="" width="496px" height="500px">
                                </div>
                                <div class="card-footer text-muted">
                                    <nav class="voucher-tab">
                                        <div class="nav nav-tabs" id="m-Tab" role="tablist">
                                            <a class="nav-item nav-link active" id="info" href="#nav-info">Informasi</a>
                                            <a class="nav-item nav-link" id="ketentuan" href="#nav-ketentuan">Ketentuan</a>
                                            <a class="nav-item nav-link" id="penukaran" href="#nav-tukar">Penukaran</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="m-tabContent">
                                        <div class="tab-pane fade show active" id="nav-info">
                                            
                                        </div>
                                        <div class="tab-pane fade" id="nav-ketentuan">
                                            Voucher berlaku hingga [Voucher End Date]
                                        </div>
                                        <div class="tab-pane fade" id="nav-tukar">
                                                    
                                            <div id="nav-tukar-btn" class="nav-tab-btn" style="display:none">

                                                <div>
                                                    <div style="text-align: justify;text-justify: inter-word; width:48%; float:left">
                                                        <button type="button" class="btn btn-wide-block btn-green border-0" id="btn-copy">Online Store</button>
                                                        <p class="">*Salin kode voucher untuk di gunakan pada online store</p>
                                                    </div>
                                                    <div style="text-align: justify;text-justify: inter-word; width:48%; float:right">
                                                        <button type="button" class="btn btn-wide-block btn-green  border-0" data-toggle="modal" data-target="#storeCodeModal">Offline Store</button>
                                                        <p class="">*Hanya dapat dilakukan oleh petugas kasir</p>
                                                    </div>
                                                </div>
                        
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- /.card -->

                        <div class="tab-footer">
                            <div class="tab-footer-item active" id="nav-info-footer">
                                <!-- Cara Penukaran Voucher -->
                                <div id="nav-info-card" class="card card-form card-extra">
                                    <div class="card-header">
                                        <h5 class="card-title">Cara Penukaran Voucher</h5>
                                    </div>
                                    <ul class="text-list">
                                        <li>
                                        [Voucher Shot Information]
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.card -->

                                <div id="nav-info-btn" class="nav-tab-btn">
                                    <button id="tukarkanVoucher" type="button" class="btn btn-wide-block btn-green btn-add-campaign btn-redeem-voucher border-0">Tukarkan Voucher</button>
                                </div>
                            </div>
                            <div class="tab-footer-item" id="nav-ketentuan-footer">
                                <!-- Syarat dan Ketentuan -->
                                <div id="nav-ketentuan-card" class="card card-form card-extra">
                                    <div class="card-header">
                                    <h5 class="card-title">Syarat dan Ketentuan</h5>
                                    </div>
                                    <ul class="text-list">
                                    <li>
                                    [voucher term & condisition]
                                    </li>
                                    </ul>
                                </div>
                                <!-- /.card -->

                                <!-- Syarat dan Ketentuan -->
                                <div id="nav-ketentuan-card2" class="card card-form card-extra" style="display: none">
                                    <div class="card-header">
                                        <h5 class="card-title">Dapat Ditukar Pada Outlet</h5>
                                    </div>
                                    <div>
                     
                                        <div style="margin:10px">
                                            <button type="button" class="btn btn-wide-block btn-green border-0" id="btn-search-outlet">Cari Outlet</button>
                                        </div>
                                       
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                    <!-- /.sidebar-area -->
                    </div>
                </div>
            </div>

        </div>
        <!-- /.site -->

        <div class="footer-social">
        <div class="row">
            <div class="col-md-12">
              <ul class="list-unstyled">
                  <li><a href="https://www.instagram.com/prezentvoucher/" target="_blank" class="soc-instagram"><i class="fab fa-instagram"></i></a></li>
                  <li><a href="https://prezent.co.id/" target="_blank" class=""><i class="fa fa-globe"></i></a></li>
                <li><a href="https://twitter.com/prezentvoucher" target="_blank" class="soc-twitter"><i class="fab fa-twitter"></i></a></li>
              </ul>
            </div>
          </div>
        </div>


        <!-- modal copied voucher number -->
        <div class="modal fade" id="copyVoucherModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <p class="text-center">
                            <img src="{{ asset('assets/img/img-success.svg') }}" alt="">  <br>
                            <b>Tersalin !</b> <br>
                            <code class="voucher-code"></code> <br>
                            Silahkan masukkan kode voucher berikut ke online store untuk redeem voucher
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Store Code Modal -->
        <div class="modal fade" id="storeCodeModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <p class="text-center">
                            Ini merupakan voucher Prezent, untuk menukarkan mohon masukkan outlet code Anda
                        </p>
                        <form id="storeCodeForm">
                            <input type="text" class="form-control" id="outlet_authentification_code" name="outlet_authentification_code" placeholder="Store Code" autocomplete="off">
                            <button type="submit" id="btnRedeem" class="btn btn-wide-block btn-green btn-add-campaign btn-redeem-voucher border-0">Redeem</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Store Code Modal -->
        <div class="modal fade" id="statusModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <p class="text-center">
                            <img id="status_image" src="{{ asset('assets/img/img-error.svg') }}" alt="">
                           <!-- <img src="img/img-error.svg" alt=""> -->
                        </p>
                        <h4 class="text-center" id="status_title">Store Code Salah</h4>
                        <p id="status-text" class="text-center">Loading ..</p>
                        <button type="button" class="btn btn-wide-block btn-green btn-add-campaign btn-redeem-voucher border-0" data-dismiss="modal">Coba Lagi</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal success -->
        <div class="modal fade" id="successModal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <b class="text-center counter text-danger float-right"></b>
                            </div>
                            <div class="col-md-12">
                                <p class="text-center">Tukarkan QR code ini kepada kasir/loket penukaran</p>
                            </div>
                        </div>
                        <p class="text-center">
                            <a href='javascript:;' id="qrcode"></a>
                        </p>
                        <p class="text-center">
                            <img id="status_image" src="{{ asset('assets/img/img-success.svg') }}" alt="">
                        </p>
                        <h4 class="text-center" id="status_title">Success Redeem Voucher</h4>
                        
                        <p id="status-text" class="text-center">Success! voucher [<span id="voucher-no"></span>] has been redeemed on <span id="redeem-date"></span> Please inform customer.</p>

                        <button type="button" id="btn-ok" class="btn btn-wide-block btn-green border-0">OK</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- search outlet modal -->
        <div class="modal fade" id="modal-search-outlet">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h7 class="modal-title">Cari Berdasarkan Kota Kamu</h7>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                    <div class="modal-body">

                        <div class="form-section row">
                            <div class="col-md-12">
                                <select class="form-control" id="outlet-city-list">
                                    
                                </select>
                            </div>
                        </div><hr>
                        <div id="outlet-detail-list">
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-wide-block btn-green border-0" data-dismiss="modal" >Close</button>
                    </div>
                </div>
            </div>
        </div>
		
@extends('partials.footer_cust')