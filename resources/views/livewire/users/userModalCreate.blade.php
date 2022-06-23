<div class="modal h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50">
    <!-- modal -->
    <div class="bg-white rounded shadow-lg w-10/12 md:w-1/3">
      <!-- modal header -->
      <div class="border-b px-4 py-2 flex justify-between items-center">
        <h3 class="font-semibold text-lg">Registrar Nuevo Usuario</h3>
        <button wire:click="closeModal()" class="text-black close-modal">&cross;</button>
      </div>
      <!-- modal body -->
      <div class="p-3">
        <form>
          <label class="relative block border-2 border-gray-200 rounded-lg p-1 my-1" for="username">
            <span class="text-xs font-medium text-gray-500" for="username">
              Usuario
            </span>
            <input wire:model="username" class="w-full p-0 text-sm border-none focus:ring-0" id="username" type="text" placeholder="Ingrese su usuario" />
          </label>
          <label class="relative block p-1 border-2 border-gray-200 rounded-lg my-1" for="name">
            <span class="text-xs font-medium text-gray-500" for="name">
              Nombres
            </span>
            <input wire:model="name" class="w-full p-0 text-sm border-none focus:ring-0" id="name" type="text" placeholder="Ingrese sus nombres" />
          </label>
          <label class="relative block p-1 border-2 border-gray-200 rounded-lg my-1" for="f_last_name">
            <span class="text-xs font-medium text-gray-500" for="f_last_name">
              Apellido Paterno
            </span>
            <input wire:model="f_last_name" class="w-full p-0 text-sm border-none focus:ring-0" id="f_last_name" type="text" placeholder="Ingrese su Apellido Paterno" />
          </label>
          <label class="relative block p-1 border-2 border-gray-200 rounded-lg my-1" for="m_last_name">
            <span class="text-xs font-medium text-gray-500" for="m_last_name">
              Apellido Materno
            </span>
            <input wire:model="m_last_name" class="w-full p-0 text-sm border-none focus:ring-0" id="m_last_name" type="text" placeholder="Ingrese su Apellido Paterno" />
          </label>
          <label class="relative block p-1 border-2 border-gray-200 rounded-lg my-1" for="nit">
            <span class="text-xs font-medium text-gray-500" for="nit">
              CI o NIT
            </span>
            <input wire:model="nit" class="w-full p-0 text-sm border-none focus:ring-0" id="nit" type="text" placeholder="Ingrese su CI o NIT" />
          </label>
          <label class="relative block p-1 border-2 border-gray-200 rounded-lg my-1" for="cellphone">
            <span class="text-xs font-medium text-gray-500" for="cellphone">
              Celular
            </span>
            <input wire:model="cellphone" class="w-full p-0 text-sm border-none focus:ring-0" id="cellphone" type="number" placeholder="Ingrese su Celular" />
          </label>
          <label class="relative block p-1 border-2 border-gray-200 rounded-lg my-1" for="address">
            <span class="text-xs font-medium text-gray-500" for="address">
              Direccion
            </span>
            <input wire:model="address" class="w-full p-0 text-sm border-none focus:ring-0" id="address" type="text" placeholder="Ingrese su Direccion" />
          </label>
        </form>
      </div>
      <div class="flex justify-end items-center w-100 border-t p-1">
        <button wire:click="closeModal()" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mr-3 close-modal">Cancelar</button>
        <button wire:click.prevent="store()" class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white">Registrar</button>
      </div>
    </div>
  </div>