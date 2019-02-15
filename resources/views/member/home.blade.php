<?php 
// $for = get_cookie('hashformula');
// debug($for);
// $cookie = $_COOKIE;
// $tokenhash = $cookie['tokenhash'];

// $a = get_cookie('tokenhash','member_id');
// $a = is_member();
// debug('test<hr/>');
// debug($a,1);

// debug($a,1);
// debug($_COOKIE,1);
$cookie_member = NULL;
$cookie_member = get_cookie('tokenhash');
?>
<div class="col-sm-12">
	<div style="margin-top:150px">
		Selamat datang {!! $cookie_member['email'] !!}
		<hr/>
		Silakan pilih menu 
	</div>
</div>