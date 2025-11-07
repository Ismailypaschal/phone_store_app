@extends('layouts.admin-app')
@section('content')

    <div class="flex flex-wrap mx-auto">
        <div class="w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border border-gray-300 shadow-lg rounded-lg">

                <!-- Tabs -->
                <div class="sticky top-0 z-10 bg-white">
                    <div class="border-b border-gray-200">
                        <div class="flex px-4 justify-between">
                            <a class="flex flex-col items-center justify-center border-b-4 border-blue-600 pb-3 pt-4 flex-1"
                                href="#">
                                <p class="text-blue-600 text-sm font-bold leading-normal">Brands</p>
                            </a>
                            <a class="flex flex-col items-center justify-center border-b-4 border-transparent pb-3 pt-4 flex-1"
                                href="#">
                                <p class="text-gray-500 text-sm font-bold leading-normal">Categories</p>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="px-4 py-4 bg-gray-100">
                    <label class="block w-full">
                        <div class="flex w-full items-center rounded-lg h-12 shadow-sm border border-gray-300 bg-white">
                            <div class="flex items-center justify-center pl-4">
                                <span class="material-symbols-outlined text-gray-500">search</span>
                            </div>
                            <input
                                class="flex-1 px-4 py-2 rounded-r-lg text-gray-700 focus:outline-none focus:border-blue-500"
                                placeholder="Search for a brand" value="">
                        </div>
                    </label>
                </div>

                <!-- List of Brands -->
                <div class="px-4 py-2">
                    <!-- List Item -->
                    <div
                        class="flex items-center justify-between bg-white p-4 rounded-lg shadow border border-gray-200 mb-3">
                        <div class="flex items-center">
                            <img class="rounded-lg w-10 h-10 bg-gray-200 p-2 mr-4"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCXcxQ5md6ml31RSBFqwsObefft1dl1bwu_0UauDq6ts9f8nehBj13ljzQCYeBvrvvVN75QTmxw_U6NXZCAwHbPPCmkUzPYDYivGu-PR7A9rchesP0BTwlON5COLSB-eVpRMYcdpzpE3QciN-fA-c3CPjGafLusmQiBfEMoxwvQ60k6smMVhUsyKIp_yAjnzSUI2outWc6Vv5JSI-M-vgqKhavP8mf8WhxuEBswKHz-9SOEfWxmLBp1aB8SB--nHBAf3fNepHyZHr1u">
                            <p class="text-gray-800 text-base font-medium leading-normal">Apple</p>
                        </div>
                        <button class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-200 transition">
                            <span class="material-symbols-outlined text-gray-600">edit</span>
                        </button>
                    </div>

                    <!-- List Item -->
                    <div
                        class="flex items-center justify-between bg-white p-4 rounded-lg shadow border border-gray-200 mb-3">
                        <div class="flex items-center">
                            <img class="rounded-lg w-10 h-10 bg-gray-200 p-2 mr-4"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuA3gekDo6PNHAvH1YS3tEBh5Lt84_Xd9Q5GEXKU0OYyBTfaOYivEiYyTbku77STk9BnmcJNu-2OBcZYcdaFtygwXOEbfrVfrh7kBWnOnUF1BrHMSbqOPyUi5OC40lXUk_XmMtppyLyTDFXKqPeIeI77AGCQ4gJ4XHkrUDUl9tYsTMTO8Vn8Jfyjb4G2Wz0k-sFj6m3lEcgPMrcr8ri-4WFfg3meW0T0KMfkfzRgKGp1OCY3uRKkMahznmrbS3iS0I1HDZjsHHri2_fH">
                            <p class="text-gray-800 text-base font-medium leading-normal">Samsung</p>
                        </div>
                        <button class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-200 transition">
                            <span class="material-symbols-outlined text-gray-600">edit</span>
                        </button>
                    </div>

                    <!-- List Item -->
                    <div
                        class="flex items-center justify-between bg-white p-4 rounded-lg shadow border border-gray-200 mb-3">
                        <div class="flex items-center">
                            <img class="rounded-lg w-10 h-10 bg-gray-200 p-2 mr-4"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAHDhtFI7QMWJiBsCm4SL8inzZ6_jNjwUJF9IfGne0-mIVgYr5lk49c_ozjiHDJbj2sVTDe3Y4h8lRSqngV6YasBkqXvDCoEMUc2mGerelUJl8RFSMNvH-8QA78By3WOAPLvOboVRwYdAssdgmAzIVXm0YtDzXi244Mzrcmx2mAd_cYslTgmIWn_aIqMIbER8Cyu_wApuNiZZTi1TP2nZzSV_Yw6NdWfrnIswvnqt4ORe3w0x8LMh21IQMQ9G9jk9jtTSOaxbqUOFw6">
                            <p class="text-gray-800 text-base font-medium leading-normal">Google</p>
                        </div>
                        <button class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-200 transition">
                            <span class="material-symbols-outlined text-gray-600">edit</span>
                        </button>
                    </div>
                </div>

                <!-- Floating Action Button -->
                <div class="fixed bottom-6 right-6 z-20">
                    <button
                        class="flex items-center justify-center w-14 h-14 rounded-full bg-blue-600 text-white shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="material-symbols-outlined text-3xl">add</span>
                    </button>
                </div>

                <!-- Modal -->
                {{-- <div class="fixed inset-0 z-30 flex items-end justify-center bg-black opacity-75">
                    <div class="w-full max-w-lg rounded-t-lg bg-white p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-gray-800">Edit Brand</h2>
                            <button class="text-gray-500">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="brand-name">Brand Name</label>
                            <input
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="brand-name" type="text" value="Apple">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Brand Logo</label>
                            <div class="flex items-center">
                                <img class="rounded-lg w-14 h-14 bg-gray-200 p-2 mr-4"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuD3Kyts1S86dPv9XwMM1TM7_sXWsKeiSs1HhwI5ifJWQzmGb5drNHqS-oBXF5BETxBORAdwWku9fY7ULMG8GoeRQ_1exao0fg1e-ZcgAO8F_NsreNDtyqmXMHJhFDYLjlNbXF8pOFs9kjRDL-AaZzuZ4edEbNFvd2nzjCiFUG7328cTCyetTGPEIhwhSeGUcITY2IvJ_CpXDLbR9NVbzHfugXBeY-MDc4ugGe35fkRLTVhtx0hUYndmUof8bPR2FMeTKJ8X-bjVLbIB">
                                <label class="cursor-pointer text-blue-600 font-semibold">
                                    <div
                                        class="flex items-center justify-center h-10 px-6 border border-dashed border-gray-400 rounded-lg">
                                        <span class="material-symbols-outlined mr-2">upload</span>
                                        <span>Change Logo</span>
                                    </div>
                                    <input class="hidden" id="file-upload" name="file-upload" type="file">
                                </label>
                            </div>
                        </div>
                        <div class="flex items-center justify-end pt-2">
                            <button
                                class="px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-200 rounded-lg mr-2">Cancel</button>
                            <button
                                class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">Save
                                Changes</button>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>

@endsection