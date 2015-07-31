<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1> Hello World </h1>
			<p> {{ text }} </p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<h1> 注册 </h1>
			<form action="/index/signup" method="POST">
				<div class="form-group">
					<input type="text" name="username" placeholder="用户名" />
				</div>
				<div class="form-group">
					<input type="password" name="password" placeholder="密码" />
				</div>
				<div class="form-group">
					<input type="email" name="email" placeholder="Email" />
				</div>
				<div class="form-group">
					<input type="text" name="name" placeholder="昵称" />
				</div>
				<button type="submit" class="btn btn-default">注册</button>
				<a href="/index" class="btn btn-default">登录</a>
			</form>
		</div>
	</div>
</div>