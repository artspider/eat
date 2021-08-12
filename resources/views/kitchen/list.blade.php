<x-layouts.master>
  {{ Breadcrumbs::render('kitchen') }}

  {{-- Solo el Chef --}}
  <div>
    <livewire:chef-on-kitchen />
  </div>


  {{-- Solo el cocinero --}}
  <livewire:kitchen-flux />
  @push('modals')
  <script>
    Livewire.on('success', message => {
      thimsg = message;
      Toast.fire({
      icon: 'success',
      title: thimsg
    });
  });

  Livewire.on('error', message => {
    thimsg = message;
    Toast.fire({
      icon: 'error',
      title: thimsg
    });
  })

  </script>
  @endpush
</x-layouts.master>