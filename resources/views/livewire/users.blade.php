<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="block space-y-4 md:flex md:space-y-0 md:space-x-4 pb-2">
           
            <button wire:click="create()" class="block w-full md:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >
            Crear Nuevo
            </button>            
            @if ($modal == 1)
              @include('livewire.users.userModalCreate')
            @endif
            @if($modal == 2)
              @include('livewire.users.userModalUpdate')
            @endif
        </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="overflow-x-auto grid py-2">
                <table  class="table-auto min-w-full text-sm divide-y divide-gray-200">
                  <thead>
                    <tr>
                      <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Nombre de Usuario
                        </div>
                      </th>
                      <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Nombres                          
                        </div>
                      </th>
                      <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Apellido Paterno                         
                        </div>
                      </th>
                      <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Apellico Materno                          
                        </div>
                      </th>
                      <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Nit                          
                        </div>
                      </th>
                      <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Celular
                        </div>
                      </th>
                      <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Direccion                          
                        </div>
                      </th>
                      <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Acciones
                        </div>
                      </th>
                    </tr>
                  </thead>
              
                  <tbody class="divide-y divide-gray-100">
                    @foreach ($users as $user)
                      <tr>
                        
                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                          <strong
                            class="bg-red-100 text-red-700 px-3 py-1.5 rounded text-xs font-medium"
                          >
                            {{ $user->username }}
                          </strong>
                        </td>
                        <td class="p-4 text-gray-700 whitespace-nowrap">{{ $user->people->name }}</td>
                        <td class="p-4 text-gray-700 whitespace-nowrap">
                          {{ $user->people->f_last_name }}
                        </td>
                        <td class="p-4 text-gray-700 whitespace-nowrap">{{ $user->people->m_last_name }}</td>
                        <td class="p-4 text-gray-700 whitespace-nowrap">{{ $user->people->nit }}</td>
                        <td class="p-4 text-gray-700 whitespace-nowrap">{{ $user->people->cellphone }}</td>
                        <td class="p-4 text-gray-700 whitespace-nowrap">{{ $user->people->address }}</td>
                        <td>
                          <div class="flex items-center -space-x-4 hover:space-x-1">
                            

                            <button wire:click="edit({{ $user->id }})"
                              class="z-20 block p-4 text-dark-700 transition-all bg-green-200 border-2 border-white rounded-full active:bg-blue-50 hover:scale-110 focus:outline-none focus:ring"
                              type="button"
                            >
                              <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                              </svg>
                            </button>

                            <button wire:click="delete({{ $user->id }})"
                              class="z-30 block p-4 text-dark-700 transition-all bg-red-200 border-2 border-white rounded-full hover:scale-110 focus:outline-none focus:ring active:bg-red-50"
                              type="button"
                            >
                              <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                              </svg>
                            </button>
                          </div>
                        </td>
                      </tr>  
                    @endforeach
                    
              
                
                  </tbody>
                </table>
              </div>
            </div>
            
        </div>
    </div>
    
</div>
