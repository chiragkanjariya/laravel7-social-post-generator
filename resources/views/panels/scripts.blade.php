    {{-- Vendor Scripts --}}
        <script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/ui/prism.min.js')) }}"></script>

        @yield('vendor-script')
        {{-- Theme Scripts --}}
        <script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
        <script src="{{ asset(mix('js/core/app.js')) }}"></script>
        <script src="{{ asset(mix('js/scripts/components.js')) }}"></script>

@if($configData['blankPage'] == false)

        <script src="{{ asset(mix('js/scripts/footer.js')) }}"></script>
@endif
        {{-- page script --}}
        @yield('page-script')

    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
          cluster: 'eu',
          forceTLS: false
        });

        var channel = pusher.subscribe('admin-channel');
        channel.bind('notification-event', function(data) {
        console.log(data)

        Notification.requestPermission(permission => {
              let notification = new Notification('New post alert!', {
                  body: 'aaa', // content for the alert
                  icon: "https://pusher.com/static_logos/320x320.png" // optional image url
              });

              // link to page on clicking the notification
              notification.onclick = () => {
                  const url = new URL(window.location.href);
                  let message_url = url.protocol + '//' + url.hostname;
                  if (url.port) message_url += ':' + url.port;
                  message_url += '/messages'
                  window.open(message_url);
              };
          });
        });
    </script>
