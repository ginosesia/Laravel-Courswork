

<nav class="navbar navbar-inverse">
    <div class="container">
    <div class="container-fluid">
      <div class="navbar-header">
        <a style="color: #fff" class="navbar-brand" href="/">InstaChat</a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="/">Home</a></li>
        <li><a href="/posts">Posts</a></li>
  
            <li><a href="/posts/create">New Post</a></li>
          </ul>
      </ul>
<!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @else
        <?php
  $numberofnotifications = auth()->user()->unreadNotifications->where('name','!=', Auth::user()->name)->count();
?>
        <li class="dropdown" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <i class="fa fa-bell" style="padding: 0; margin-right: 7px;"></i>
            @if($numberofnotifications > 0)
              <span class="badge bg-secondary">{{$numberofnotifications}}</span>
            @endif
          </a>
            <ul class="dropdown-menu"  role="menu">
              @if(auth()->user()->unreadNotifications->count() == 0 && auth()->user()->readNotifications->count() == 0)
                <h6>No Notifications</h6>
              @endif
              @if(auth()->user()->unreadNotifications->count() > 0)
              <h6>Notifications:</h6>
                  @foreach (auth()->user()->unreadNotifications as $notification)
                    @if($notification->data['data']['name'] == Auth::user()->name)
                      <?php
                        $name = 'You commented on your own post.';
                      ?>
                      @else
                      <?php
                        $name = $notification->data['data']['name'] . ' commented on your post.';
                      ?>
                      @endif
                      <a class="notification" href="/posts/{{$notification->data['data']['post']}}">
                        <div class="row" style="width: 400px; padding-right: 35px;">
                            <div class="col-md-3">
                                <img alt="Profile-Image" src="{{"https://www.gravatar.com/avatar/" . md5(strtolower(trim($notification->data['data']['email'])))."?s=50&d=wavatar"}}" class="author-image">
                            </div>
                            <div class="col-md-9">
                              <div class="row" style="margin-left: 2px;">
                                <li>{{$name}}</li>
                                <li><small>{{$notification->data['data']['body']}}</small></li>
                              </div>
                              <div class="row" style="margin-left: 2px;">
                                <li><small style="font-size: 10px;"><i>
                                  {{date('d-m-Y H:i:s', strtotime($notification->data['data']['date']))}}
                                </i></small></li>
                              </div>
                            </div>
                        </div>
                      </a>
                    <hr style="margin:0; margin-top: 8px; margin-left: 80px;">
                    
                  @endforeach
              <div class="row">
                <div class="read">
                  @if(auth()->user()->unreadNotifications->count() == 1)
                  <li><a style="float: right; color: #007bff; margin-bottom: 5px;" href="{{route('markRead')}}">Mark as read</a></li>
                  @else
                  <li><a style="float: right; color: #007bff; margin-bottom: 5px;" href="{{route('markRead')}}">Mark all as read</a></li>
                  @endif
                </div>
              </div>
              @endif
              @if(auth()->user()->readNotifications->count() >0)
              <h6>Old Notifications:</h6>
                  @foreach (auth()->user()->readNotifications as $notification)
                  @if($notification->data['data']['name'] == Auth::user()->name)
                  <?php
                    $name = 'You commented on your own post.';
                  ?>
                  @else
                  <?php
                    $name = $notification->data['data']['name'] . ' commented on your post';
                  ?>
                  @endif
                    <a class="notification" href="/posts/{{$notification->data['data']['post']}}">
                      <div class="row" style="width: 400px; padding-right: 35px;">
                        <div class="col-md-3">
                          <img alt="Profile-Image" src="{{"https://www.gravatar.com/avatar/" . md5(strtolower(trim($notification->data['data']['email'])))."?s=50&d=wavatar"}}" class="author-image">
                        </div>
                      <div class="col-md-9">
                        <div class="row" style="margin-left: 2px;">
                          <li>{{$name}}</li>
                          <li><small>{{$notification->data['data']['body']}}</small></li>
                        </div>
                        <div class="row" style="margin-left: 2px;">
                          <li><small><i>
                          {{date('d-m-Y H:i:s', strtotime($notification->data['data']['date']))}}
                        </i></small></li>
                        </div>
                      </div>
                    </div> 
                  </a>         
                    <hr style="margin:0; margin-top: 8px; margin-left: 80px;">
                  @endforeach
                <div class="row">   
                  <div class="clear">
                    <li><a style="float: right; color: #dc3545; margin-top: 5px;" href="{{route('clearAll')}}">Clear all</a></li>
                  </div>
                </div>
                @endif
            </ul>
        </li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">

                    <li style="margin-top: 5px; padding-left: 20px; color: gray;">{{ Auth::user()->role }} 
                    </li>
                      <hr style="margin: 8px 0 8px 0;">
                      <li><a href="/home">Dashboard</a></li>
                      <li><a href="/profile">Profile</a></li>
                      <li><a href="/tags">Tags</a></li>
                      <hr style="margin: 8px 0 8px 0;">
                      <li>
                          <a href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                              Logout
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                      </li>
                  </ul>
              </li>
          @endif
        </ul>
    </div> 
  </div>
</nav>

{{-- @foreach($unreadnotifications as $notification) {
  @if($notification->data['data']['name'] != Auth::user()->name)
    {{$notification->data['data']['name']}}
  @endif
@endforeach --}}

<style>

.hover {
  background: #007bff;
}

.col-md-3 {
  padding-left: 30px;
  padding-top: 5px;
}

.col-md-1 {
  float: right;
  margin-top: 9px;
}

.col-md-9 {
  float: left;
  margin: 0;
  margin-top: 9px;
  padding: 0;
}

.author-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  float: left;
}

.navbar {
  border-radius: 0px;
  border-width: 0px;
  padding: 5px 0 5px 0;
  top: 0;
  width: 100%;
}

a:hover {
  text-decoration: initial;  
}

h6 {
  padding-left: 10px;
  padding-bottom: 8px;
  padding-top: 8px;
  background: #f1f1f1;
  margin: 0;
  font-size: 13px;
  font-weight: bold;
}

.notification {
  margin: 0;
  padding: 0;
}

.no_notification {
  margin-top: 5px;
  margin-bottom: 5px;
  margin-left: 20px;
}

.clear {
  margin-right: 35px;
  margin-left: 35px;
}

.read {
  margin-right: 35px;
  margin-left: 35px;
  margin-top: 6px; 
  margin-bottom: 6px; 
}

</style>