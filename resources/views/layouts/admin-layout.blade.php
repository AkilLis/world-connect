<!doctype html>
<html>
<head>
    @include('includes.resource')
    @include('includes.admin-header')
</head>
<body>
	<div class="wrapper">
	    <div class="sidebar" data-color="orange">
	    	<div class="sidebar-wrapper">
	            <div class="logo">
	                <a href="http://worldconnect.mn" class="simple-text">
	                    World Connect	
	                </a>
	            </div>

	            <ul class="nav">
	                <li class="{{$currentView == 'country-view' ? 'active' : ''}}">
	                    <a href="/admin/country">
	                        <i class="pe-7s-graph"></i>
	                        <p>Улс</p>
	                    </a>
	                </li>
	                <li class="{{$currentView == 'school-view' ? 'active' : ''}}">
	                    <a href="/admin/school">
	                        <i class="pe-7s-graph"></i>
	                        <p>Сургууль</p>
	                    </a>
	                </li>
	                <li class="{{$currentView == 'news-view' ? 'active' : ''}}"> 
	                    <a href="/admin/news">
	                        <i class="pe-7s-graph"></i>
	                        <p>Мэдээлэл</p>
	                    </a>
	                </li>
	                <li class="{{$currentView == 'album-view' ? 'active' : ''}}">
	                    <a href="/admin/album">
	                        <i class="pe-7s-graph"></i>
	                        <p>Зургийн цомог</p>
	                    </a>
	                </li>
	            </ul>
	    	</div>
	    </div>

	    <div class="main-panel">
	        <nav class="navbar navbar-default navbar-fixed">
	            <div class="container-fluid">
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle" data-toggle="collapse">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                    </button>
	                    <a class="navbar-brand" href="#">Админ</a>
	                </div>
	                <div class="collapse navbar-collapse">
	                    <!-- <ul class="nav navbar-nav navbar-left">
	                        <li>
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                                <i class="fa fa-dashboard"></i>
	                            </a>
	                        </li>
	                    </ul> -->
	                    <div id="password" class="modal password" data-easein="fadeIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="top: 20% !important">
					      <div class="modal-dialog" style="width: 400px;">
					        <div class="modal-content">
					          <div class="modal-header">
					          	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					            <h4 class="modal-title" id="myModalLabel">Нууц үг солих</h4>
					          </div>
					          <div class="modal-body">
					          	<form class="form-group">
					          		<div class="row text-center">
					          			<label> Хуучин нууц үг
					          				<input class="form-control" v-model="user.oldPass" type="password" name="oldpassword" autofocus="true">
					          			</label>
					          		</div>
					          		<div class="row text-center">
						          		<label> Шинэ нууц үг
						          			<input class="form-control" v-model="user.newPass" type="password" name="newspassword">
						          		</label>
					          		</div>
					          		<div class="row text-center">
						          		<label> Давтан оруулна уу
							          		<input class="form-control" v-model="user.verifyPass" type="password" name="verifypassword">
							          	</label>
					          		</div>
					          	</form>
					          </div>
					          <div class="modal-footer">
								<a @click="setNewPassword()" style="margin-right: 10px;" class="btn btn-info btn-fill btn-warning pull-right">Хадгалах</a>
					          </div>
					        </div>
					      </div>
					    </div>

	                    <ul class="nav navbar-nav navbar-right">
	                    	<li>
	                    		<a @click="passwordModal()">
	                    			<i class="fa fa-cogs"></i>Нууц үгээ солих	
	                    		</a>
	                    	</li>
	                        <li>
	                           <a href="/logout">
	                             	<i class="fa fa-sign-out"></i>  Гарах
	                            </a>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </nav>

	        <div class="content" style="">
	            <div class="container-fluid">
	                <div class="row">
	                	<component is="{{$currentView}}" 
					               inline-template>
					  		@yield('content')
						</component>	
	                </div>
	            </div>
	        </div>

	        <footer class="footer">
	            <div class="container-fluid">
	                <nav class="pull-left">
	                    <ul>
	                        <li>
	                            <a href="#">
	                                Home
	                            </a>
	                        </li>

	                    </ul>
	                </nav>
	                <p class="copyright pull-right">
	                    &copy; 2016 <a href="http://simplood.com">Simplood Team</a>
	                </p>
	            </div>
	        </footer>

	    </div>
	</div>
	<core-notify v-ref:notify>
	</core-notify>

	<div id="loader" class="modal loader" data-easein="fadeIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="top: 20% !important">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Уншиж байна</h4>
          </div>
          <div class="modal-body">
          	LOADING ...
          </div>
        </div>
      </div>
    </div>

	@include('includes.admin-script')
</body>
</html>
