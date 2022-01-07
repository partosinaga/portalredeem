@extends('layouts/main')
@section('title', 'Balance')
@section('contentTitle', 'Edit Balance')
@section('content')
<div class="container" id="main-content">
<div class="row">
<div class="main-content__body container-fluid">
  <div class="row justify-content-md-center mt-60">
    <div class="col-md-9">
      <form action="{{ route('balance.topup.update') }}" method="POST" id="add-deposit-form"  enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="">
        <div class="content-area__main">
          <div class="form-section">
			<h1>{{$title}}</h1>
            <h2 class="heading">{{ @$deposit ? 'Update Data Deposit' : 'Add Deposit' }}</h2>
            <p>Add client deposit balance to run campaign properly, simply call Prezent Admin in order to add deposit. <br>
            <i style="color:red">Please make sure you fill a valid data, once form submitted, can't edit anymore!</i></p>
          </div>
          <div class="form-section expand-col-12 row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group form-group__validity-period">
                  <label>Date</label>
                  <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-group">
							<div class="input-group date" id="topupDate" data-target-input="nearest">
								<input type="text" class="form-control datetimepicker-input" name="deposit_payment_date" data-target="#topupDate" value="{{$d->deposit_payment_date}}" />
								<div class="input-group-append" data-target="#topupDate" data-toggle="datetimepicker">
									<span class="input-group-text">
										<i class="ki ki-calendar"></i>
									</span>
								</div>
							</div>
						</div>
                      </div>
                  </div>
                </div>
            </div>
          </div>
          <!-- /.form-section.row -->
          <div class="form-section row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="deposit-transaction-type">Transaction Type</label>
                <select name="deposit_transaction_type" class="custom-select dropdown-select2" id="deposit-transaction-type" required>
                  <option value="">Choose...</option>
				  <option value="topup" selected>Top Up</option>
				  <option value="adj">Adjusment</option>
                </select>
              </div>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-input">
                      <label for="deposit-document-number">Document Number</label>
                      <input name="deposit_document_number" type="text" class="form-control" id="deposit-document-number" value="{{$d->deposit_document_number}}">
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.form-section.row -->

          <div class="row form-section">
            <div class="col-12">
              <div id="upload_button">
                  <label class="width--full">
					Attachment
                    <input id="uploadInput" class="form-control" type="file" name="deposit_document_url" accept="image/*">
                  </label>
                  <p>.jpg, .jpeg, .png</p>
                </div>
            </div>
          </div>

          <div class="form-section row">
              <div class="col-md-6">
                  <div class="form-group">
                  <label for="deposit-client">Select Client</label>
                  <select name="client_id" class="custom-select dropdown-select2" id="deposit-select-client" required>
                      <option value ="" selected>Choose...</option>
					  @foreach($clients as $cl)
					  <option value="{{$cl->client_id}}">{{$cl->client_title}}</option>
					  @endforeach
                  </select>
                  </div>
              </div>
              <!-- /.col-md-6 -->
              <div class="col-md-6">
                  <div class="form-group">
                      <div class="form-input">
                          <label for="receipt-number">Receipt Number</label>
                          <input name="deposit_receipt_number" type="text" class="form-control" id="receipt-number" value="{{$d->deposit_receipt_number}}" required>
                      </div>
                  </div>
              </div>
              <!-- /.col-md-6 -->
          </div>


          <div class="form-section row">
              <div class="col-md-12">
                <b>Bank Account Details</b>
                <table class="table bank-account-details table-hover">
                  <tr>
                    <th style="width:20%; max-width:20%">Bank Account</th>
                    <th style="width:40%; max-width:40%">Branch</th>
                    <th style="width:20%; max-width:20%">Account Name</th>
                    <th>Account Number</th>
                  </tr>
                  <tr>
                    <td id="bank-accounts"></td>
                    <td id="branch"></td>
                    <td id="account-name"></td>
                    <td id="account-number"></td>
                  </tr>
                </table>
                <p align="center" class="bank-account-info"></p>
                <hr>
              </div>
          </div>


          <div class="form-section row">
              <div class="col-md-12">
                  <div class="form-group">
                      <div class="form-input">
                          <label for="idr-deposit-amount">Deposit Amount</label>
                          <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text">IDR</div>
                              </div>
                              <input type="text" name="deposit_amount" class="form-control number-format" id="idr-deposit-amount" required value="{{$d->deposit_amount}}">
                          </div>
                      </div>
                  </div>
              </div>
              <!--<div class="col-md-3">
                  <div class="form-group">
                      <div class="form-input">
                          <label for="idr-point">IDR per 1 Point</label>
                          <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text">IDR</div>
                              </div>
                              <input type="text" name="deposit_amount_per_point" class="form-control number-format" id="idr-point" required value="">
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <div class="form-input">
                          <label for="point-amount">Point Amount</label>
                          <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text">Pts.</div>
                              </div>
                              <input type="text" name="deposit_value_point" class="form-control" id="point-amount" required readonly value="">
                          </div>
                      </div>
                  </div>
              </div>-->
              <!-- /.col-md-6 -->
          </div>
            <!-- /.form-section.row -->


          <div class="form-section last row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-input">
                        <label for="descriptions">Descriptions</label>
                        <textarea name="deposit_description" type="text" class="form-control" id="descriptions" placeholder="" rows="4">{{$d->deposit_description}}</textarea>
                    </div>
                </div>
            </div>
          </div>
          <!-- /.form-section.row -->
          <div class="form-section clearfix">
            <div class="text-center">
              <button type="submit" class="btn btn-primary btn--width-default border-0 btn-add btn-submit">Update</button>
            </div>
          </div>
        </div>
        <!-- /.content-area__main -->
		<input type="hidden" name="id" value="{{$d->deposit_id}}"/>
      </form>
      <!-- /#campign-form -->
    </div>
    <!-- /.content-area -->
  </div> 
</div>
<!-- /. row -->
</div>
<!-- /.main-content__body -->
</div>
<!-- /#main-content -->

@endsection
@push('footer_scripts')
<script>
    $(document).ready( function () {
        $('#topupDate').datetimepicker({
			date: new Date({{strtotime('$d->deposit_payment_date')}})
		});
		$('#deposit-select-client').change(function(){
			var c_id = $(this).val();
			$.ajax({
				url: "{{ route('clients.bank') }}",
				method: "get",
				data: {
					_token: "{{ csrf_token() }}",
					id: c_id
				},
				success:function(data){
					console.log(data);			
					$('#bank-accounts').html(data.bank_title);
					$('#account-name').html(data.account_name);
					$('#branch').html(data.bank_branch);
					$('#account-number').html(data.account_number);
				},
				error:function()
				{
					console.log('error');
				}
			})
		});
		$('#deposit-select-client').val({{$d->client_id}});
        $('#deposit-select-client').trigger('change');
    })
</script>
@endpush