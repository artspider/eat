<div>
	{{ Breadcrumbs::render('users') }}

	<div x-data="{open:false}" class="">
		<div class="bg-white rounded-md shadow-md p-10 ">
			<x-utils.subtitle class="mb-4">Lista de Usuarios</x-utils.subtitle>
			<hr class=" border-eat-olive-50 mb-6 ">
			<table class="border-collapse w-full">
				<thead>
					<tr>
						<th
							class="p-3 text-xs font-light font-montserrat  uppercase bg-eat-olive-500 text-eat-white-500 border border-eat-white-200 hidden lg:table-cell">
							Nombre</th>
						<th
							class="p-3 text-xs font-light font-montserrat  uppercase bg-eat-olive-500 text-eat-white-500 border border-eat-white-200 hidden lg:table-cell">
							Rol</th>
						<th
							class="p-3 text-xs font-light font-montserrat  uppercase bg-eat-olive-500 text-eat-white-500 border border-eat-white-200 hidden lg:table-cell">
							Direccion</th>
						<th
							class="p-3 text-xs font-light font-montserrat  uppercase bg-eat-olive-500 text-eat-white-500 border border-eat-white-200 hidden lg:table-cell">
							Teléfono</th>
						<th
							class="p-3 text-xs font-light font-montserrat  uppercase bg-eat-olive-500 text-eat-white-500 border border-eat-white-200 hidden lg:table-cell">
							Acciones</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($users as $user)
					<tr
						class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
						<td
							class="w-full lg:w-auto p-3 text-gray-800 border border-b block lg:table-cell relative lg:static h-28 flex items-center justify-center md:h-auto">
							<span
								class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-montserrat uppercase">
								Nombre
							</span>
							<div class="flex items-center">
								<div class=" flex-shrink-0 h-10 ">
									<img class="h-10 w-10 rounded-full" src="{{$user->profile_photo_url}}" alt="">
								</div>
								<div class="ml-4 text-sm font-montserrat">
									<div class="">{{$user->name}}</div>
									<div>{{$user->email}}</div>
								</div>
							</div>

						</td>
						<td
							class="w-full lg:w-auto p-3 text-gray-800  border border-b text-center block lg:table-cell relative lg:static h-16 flex items-center justify-center md:h-auto">
							<span
								class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Rol</span>
							@forelse ($user->getRoleNames() as $role)
							<p class="text-sm font-montserrat">{{$role}}</p>
							@empty
							No tiene Rol asignado
							@endforelse

						</td>
						<td
							class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
							<span
								class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Dirección</span>
							<span class="font-montserrat text-sm">
								@isset($user->address)
								<p class="text-sm font-montserrat">{{$user->address}}</p>
								@endisset
								@empty($user->address)
								<p class="text-sm font-montserrat text-eat-white-500 bg-eat-fuccia-500">Sin dirección
									asignada</p>
								@endempty
							</span>
						</td>
						<td
							class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static h-16 flex items-center justify-center md:h-auto">
							<span
								class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Teléfono</span>
							<span class="">
								@isset($user->phone)
								<p class="text-sm font-montserrat">{{$user->phone}}</p>
								@endisset
								@empty($user->phone)
								<p class="text-sm font-montserrat text-eat-white-500 bg-eat-fuccia-500">Sin teléfono
									asignado</p>
								@endempty
							</span>
						</td>
						<td
							class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static h-16 flex items-center justify-center md:h-auto">
							<span
								class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Acciones</span>
							<div class="flex justify-center">
								<a class="mr-3" href="#" id="editUser" onclick="editUser(this,{{$user->id}})"
									data-title='Edita los datos del usuario' data-placement="left"
									class="tooltip_usr text-eat-green-400 hover:text-eat-green-600 underline">
									<x-icons.edit />
								</a>
								<a href="#" onclick="confirmAction('deleteUser', {{ $user }});"
									data-title='Elimina el usuario' data-placement="top"
									class="tooltip_usr text-eat-fuccia-500 hover:text-eat-fuccia-600 underline pl-2">
									<x-icons.remove />
								</a>
							</div>

						</td>
					</tr>

					@empty

					@endforelse


				</tbody>
			</table>
			<div class="flex justify-end mt-4">
				<x-utils.button  id="createUser" color="eat-olive">
					Crear usuario
				</x-utils.button>
			</div>
		</div>

		<dialog id="userDialog" class="bg-gray-700 bg-opacity-50 z-10 absolute top-0 w-screen h-screen">
			<div class="w-full h-full flex justify-center items-center">
				<livewire:admin.create-user />
			</div>
		</dialog>

		<dialog id="editUserDialog" class="bg-gray-700 bg-opacity-50 z-10 absolute top-0 w-screen h-screen">
			<div class="w-full h-full flex justify-center items-center">
				<livewire:admin.edit-user :user="$user->id" />
			</div>
		</dialog>
	</div>

</div>
@push('modals')

<script>
	tippy(
		'.tooltip_usr', {
    content:(reference)=>reference.getAttribute('data-title'),
    onMount(instance) {
        instance.popperInstance.setOptions({
        placement :instance.reference.getAttribute('data-placement')
        });
    },
		theme: 'tomato',	
},
);
</script>

<script>
	function editUser(id, key){
		Livewire.emit('editUser', key);
		editUserDialog.showModal();
	}
</script>
<script>
	(function() {
    var createUser = document.getElementById('createUser');
	var editUser = document.getElementById('editUser');
    var cancelButton = document.getElementById('cancel');
    var userDialog = document.getElementById('userDialog');
	var editUserDialog = document.getElementById('editUserDialog');

    // opens a modal dialog
    createUser.addEventListener('click', function() {
      userDialog.showModal();
    });

	/* editUser.addEventListener('click', function() {
		Livewire.emit('editUser', key);
		editUserDialog.showModal();
    }); */

   
  })();
</script>
<script>
	Livewire.on('success', message => {
			userDialog.close();
			thimsg = message;
			Toast.fire({
					icon: 'success',
					title: thimsg
			});
	})
</script>
<script>
	function EnableDisablePassword(chkPassword) {
        var txtPassword = document.getElementById("txtPassword");
		var txtPasswordVer = document.getElementById("txtPasswordVer");
		if(chkPassword.checked){
			alert('checado');
			txtPassword.disabled = true;
			txtPasswordVer.disabled = true;
		}else{
			txtPassword.disabled = false;
			txtPasswordVer.disabled = false;
		}
        
    }
</script>
@endpush