<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1> 登录 </h1>
			{% if text %}
			<p> {{ text }} </p>
			{% else %}
			<p><label>用户名： {{username}}</label></p>
			<p><label>昵称： {{name}}</label></p>
			<p><label>Email： {{email}}</label></p>
			{% endif %}
		</div>
	</div>
</div>