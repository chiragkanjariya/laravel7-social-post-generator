@section('content-sidebar')
  <!-- User Chat profile area -->
  <div class="chat-profile-sidebar">
    <header class="chat-profile-header">
      <span class="close-icon">
        <i class="feather icon-x"></i>
      </span>
      <div class="header-profile-sidebar">
        <div class="avatar">
          <img src="{{ asset('images/portrait/small/avatar-s-11.jpg') }}" alt="user_avatar" height="70" width="70">
        </div>
        <h4 class="chat-user-name"></h4>
      </div>
    </header>
    <div class="profile-sidebar-area">
      <div class="scroll-area pt-0">
        <p class="pb-0">
          <span class="text-bold-600 mx-50 font-medium-1">Email : </span>
          <span class="font-medium-1" id="user-email"></span>
        </p>
        <p class="pb-0">
          <span class="text-bold-600 mx-50 font-medium-1">Role : </span>
          <span class="font-medium-1" id="user-role"></span>
        </p>
        <p class="pb-0">
          <span class="text-bold-600 mx-50 font-medium-1">Status : </span>
          <span class="badge badge-success font-medium-1" id="user-status">Activated</span>
        </p>
      </div>
    </div>
  </div>
  <!--/ User Chat profile area -->
  <!-- Chat Sidebar area -->
  <div class="sidebar-content card">
    <span class="sidebar-close-icon">
      <i class="feather icon-x"></i>
    </span>
    <div class="chat-fixed-search">
      <div class="d-flex align-items-center">
        <fieldset class="form-group position-relative has-icon-left mx-1 my-0 w-100">
          <input type="text" class="form-control round" id="chat-search" placeholder="Search Profile">
          <div class="form-control-position">
            <i class="feather icon-search"></i>
          </div>
        </fieldset>
      </div>
    </div>
    <div id="users-list" class="chat-user-list list-group position-relative">
      <ul class="chat-users-list-wrapper media-list">
        @foreach($profiles as $profile)
        <li data-profile="{{ json_encode($profile) }}" data-id="{{ $profile['id'] }}">
          <div class="pr-1 sidebar-profile-toggle">
            <span class="m-0">
              @if($profile['user']->photo === null)
              <img class="media-object rounded-circle" src="{{ asset('images/avatar.png') }}" height="42" width="42" alt="Generic placeholder image">
              @else
              <img class="media-object rounded-circle" src="{{ asset('storage') . '/' . $profile['user']->photo }}" height="42" width="42" alt="Generic placeholder image">
              @endif
            </span>
          </div>
          <div class="user-chat-info">
            <div class="contact-info">
              <h5 class="font-weight-bold mb-0">{{ $profile['user']->name }} : {{ $profile['niche'] }} Profile</h5>
              @php
                $hashtags = explode(',', $profile['hashtags']);
              @endphp
              @foreach ($hashtags as $hashtag)
                <span class="badge badge-pill badge-glow badge-warning">{{ $hashtag }}</span>
              @endforeach
            </div>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
  <!--/ Chat Sidebar area -->
@endsection
