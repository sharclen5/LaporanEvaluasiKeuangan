<x-layout :title="$title">

    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div
            class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 px-6 bg-white dark:bg-gray-900">
            <div class="relative">
                <form method="GET" action="{{ route('users.index') }}">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3">
                        <button type="submit">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        </button>
                    </div>
                    <input type="text" id="table-search-users" name="search"
                        value="{{ request('search') }}"
                        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for users">
                    <button class="absolute end-0 top-2 mr-3 flex items-center text-gray-500 hover:bg-gray-700 focus:ring-3 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-0.5 text-center">
                        <a href="/user-management">X</a>
                    </button>
                </form>
            </div>
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                <svg class="w-6 h-6 dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                        clip-rule="evenodd" />
                </svg>

            </button>
        </div>

        <!-- Create Modal -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t bg-gray-700">
                        <h3 class="text-lg font-semibold text-white">
                            Add New User
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-6 md:p-5" class="p-6 md:p-5" action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Masukkan nama lengkap..." required>
                            </div>
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Masukkan email yang sesuai..." required>
                            </div>
                            <div>
                                <label for="role"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                    <select name="role" id="role"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                        required>
                                        <option value="">Pilih Role yang sesuai</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                            </div>
                            <div>
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="password" minlength="8"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Masukkan password..." required>
                            </div>                            

                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <button type="submit"
                                class="bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-2.5 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Add User
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4"></th>
                    <th scope="col" class="px-6 py-3">
                        <a
                            href="{{ route('users.index', ['sort' => 'name', 'direction' => $direction === 'asc' ? 'desc' : 'asc']) }}">
                            Name
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a
                            href="{{ route('users.index', ['sort' => 'role', 'direction' => $direction === 'asc' ? 'desc' : 'asc']) }}">
                            Role
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a
                            href="{{ route('users.index', ['sort' => 'email', 'direction' => $direction === 'asc' ? 'desc' : 'asc']) }}">
                            Email
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4"></td>
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/minisui.png') }}" alt="Test" class="w-10 h-10 rounded-full">
                            <div class="ps-3">
                                <div class="text-base font-semibold">{{ $user->name }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">{{ $user->role }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <a href="#" type="button" data-modal-target="editUserModal-{{ $user->id }}"
                                data-modal-show="editUserModal-{{ $user->id }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                        </td>
                    </tr>

                    <div id="editUserModal-{{ $user->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-lg max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-gray-700">
                                    <h3 class="text-lg font-semibold text-white">
                                        Edit User
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-toggle="editUserModal-{{ $user->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                    </button>
                                </div>
                    
                                <!-- Modal body -->
                                <div class="px-6">
                                    <!-- Circle Image -->
                                    <div class="flex justify-center mt-4">
                                        <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                                                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/minisui.png') }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                    
                                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="p-4 md:p-5" enctype="multipart/form-data">
                                        @csrf
                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                            <div class="col-span-2 sm:col-span-1">
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                                                <input type="text" name="name" id="name-{{ $user->id }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                    placeholder="Name" value="{{ $user->name }}" required>
                                            </div>
                                            <div class="col-span-2 sm:col-span-1">
                                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                                <input type="email" name="email" id="email-{{ $user->id }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                    placeholder="Email" value="{{ $user->email }}" required>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="role-{{ $user->id }}" class="block text-sm font-medium text-gray-400">Role</label>
                                                <select name="role" id="role-{{ $user->id }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                                    required>
                                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex justify-between py-4">
                                            <button type="submit"
                                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                Confirm
                                            </button>
                    
                                            <button type="button" data-modal-target="delete-modal-{{ $user->id }}"
                                                data-modal-toggle="delete-modal-{{ $user->id }}"
                                                class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                Delete
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    


                    <div id="delete-modal-{{ $user->id }}" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-gray-700 rounded-lg shadow">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="delete-modal-{{ $user->id }}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-white dark:text-gray-400">Are you sure you
                                        want to
                                        delete this entry?</h3>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Yes, I'm sure
                                        </button>
                                    </form>
                                    <button data-modal-hide="delete-modal-{{ $user->id }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                        cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>



        <!-- Pagination Links -->
        <div class="p-4">
            {{ $users->appends(['sort' => $sort, 'direction' => $direction])->links() }}
        </div>
    </div>
</x-layout>
