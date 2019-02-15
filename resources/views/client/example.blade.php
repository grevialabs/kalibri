<?php 

// debug($data,1);
$form_url = '';
$base_url = base_url();

// if ($get['do'] == 'insert') $action = $lang['add'];
// else if ($get['do'] == 'edit') $action = $lang['edit'];

// $PAGE_TITLE = $action .' '. $companylang['module']; 
// debug('gokil',1);
?>

<!-- Article AREA -->
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title">
					<h3 class="b">Test</h3>
				</div>
				
				<div><a href="{{ base_url().''.Request::segment(1).DS.Request::segment(2) }}" class="btn btn-info">{!! $lang['back_icon'] . ' ' . $lang['back'] !!}</a></div>{!! BR.BR !!}
				
				@if (session('message'))
					{!! session('message') !!}
				@endif
				
				<form method="post" action="{{ $form_url }}" class="form-horizontal">

					
					<!--
					<div class="row mb-3 align-items-center">
						<div class="col-lg-3 col-md-12">
							<span>Tooltip Input</span>
						</div>
						<div class="col-lg-6 col-lg-offset-3 col-md-12">
							<input type="text" data-toggle="tooltip" title="" class="form-control" id="validationDefault05" placeholder="Hover For tooltip" required="" data-original-title="A Tooltip for the input !">
						</div>
					</div>
					-->
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="company_name" class="control-label col-form-label">Select2 multiple</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $companylang['company_name'] }}" title="{{ $companylang['company_name'] }}" class="form-control datepicker" id="company_name" name="company_name" placeholder="{{ $companylang['company_name'] }}" required="" data-original-title="mantab bro" /><br/>
							
							<select class="select2 form-control m-t-15" multiple="multiple" style="height: 36px;width: 100%;">
								<option>Select</option>
								<optgroup label="Alaskan/Hawaiian Time Zone">
									<option value="AK">Alaska</option>
									<option value="HI">Hawaii</option>
								</optgroup>
								<optgroup label="Pacific Time Zone">
									<option value="CA">California</option>
									<option value="NV">Nevada</option>
									<option value="OR">Oregon</option>
									<option value="WA">Washington</option>
								</optgroup>
								<optgroup label="Mountain Time Zone">
									<option value="AZ">Arizona</option>
									<option value="CO">Colorado</option>
									<option value="ID">Idaho</option>
									<option value="MT">Montana</option>
									<option value="NE">Nebraska</option>
									<option value="NM">New Mexico</option>
									<option value="ND">North Dakota</option>
									<option value="UT">Utah</option>
									<option value="WY">Wyoming</option>
								</optgroup>
								<optgroup label="Central Time Zone">
									<option value="AL">Alabama</option>
									<option value="AR">Arkansas</option>
									<option value="IL">Illinois</option>
									<option value="IA">Iowa</option>
									<option value="KS">Kansas</option>
									<option value="KY">Kentucky</option>
									<option value="LA">Louisiana</option>
									<option value="MN">Minnesota</option>
									<option value="MS">Mississippi</option>
									<option value="MO">Missouri</option>
									<option value="OK">Oklahoma</option>
									<option value="SD">South Dakota</option>
									<option value="TX">Texas</option>
									<option value="TN">Tennessee</option>
									<option value="WI">Wisconsin</option>
								</optgroup>
								<optgroup label="Eastern Time Zone">
									<option value="CT">Connecticut</option>
									<option value="DE">Delaware</option>
									<option value="FL">Florida</option>
									<option value="GA">Georgia</option>
									<option value="IN">Indiana</option>
									<option value="ME">Maine</option>
									<option value="MD">Maryland</option>
									<option value="MA">Massachusetts</option>
									<option value="MI">Michigan</option>
									<option value="NH">New Hampshire</option>
									<option value="NJ">New Jersey</option>
									<option value="NY">New York</option>
									<option value="NC">North Carolina</option>
									<option value="OH">Ohio</option>
									<option value="PA">Pennsylvania</option>
									<option value="RI">Rhode Island</option>
									<option value="SC">South Carolina</option>
									<option value="VT">Vermont</option>
									<option value="VA">Virginia</option>
									<option value="WV">West Virginia</option>
								</optgroup>
							</select>

						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="company_address" class="control-label col-form-label">{!! $companylang['company_address'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<textarea type="text" data-toggle="{{ $companylang['company_address'] }}" title="" class="form-control" id="company_address" name="company_address" placeholder="{{ $companylang['company_address'] }}" required="" data-original-title="{{ $companylang['company_address'] }}"></textarea>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="company_phone" class="control-label col-form-label">{!! $companylang['company_phone'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="company_phone" name="company_phone" placeholder="{{ $companylang['company_phone'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="" class="control-label col-form-label">{!! $companylang['company_pic'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="company_pic" name="company_pic" placeholder="" required="" data-original-title="" />
						</div>
					</div>
					
					<!--
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<span></span>
						</div>
						<div class="col-lg-6 col-lg-offset-3 col-md-12">
							<input type="text" data-toggle="" title="" class="form-control" id="company_" name="company_" placeholder="" required="" data-original-title="" />
						</div>
					</div>
					-->
					
					<div class="form-group row">
						<div class="col-sm-12">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">							
							<button type="submit" class="btn btn-primary btn-md">{{ $lang['save'] }}</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready( function() {
	
	<?php 
    if (! empty($data)) 
    {
        foreach ($data as $key => $rs) 
        { 
        ?>
	$('#{{ $key }}').val('{{$rs}}');
	$('#{{ $key }}').trigger('change');
	<?php 
        }
    }

    ?>
})
</script>