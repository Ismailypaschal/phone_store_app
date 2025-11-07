@extends('layouts.admin-app')
@section('content')

  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div
        class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="dark:text-white">Manage Products</h6>
        </div>
        <!-- Search and Filter Bar -->
        <div class="px-4 py-3">
          <div class="flex items-center gap-2">
            <label class="flex flex-col h-12 w-full">
              <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                <div
                  class="text-slate-500 dark:text-slate-400 flex border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 items-center justify-center pl-3 rounded-l-lg border-r-0">
                  <span class="material-symbols-outlined">search</span>
                </div>
                <input
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-slate-900 dark:text-white focus:outline-0 focus:ring-0 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:border-primary h-full placeholder:text-slate-500 dark:placeholder:text-slate-400 px-4 pl-2 text-base font-normal leading-normal"
                  placeholder="Search by name or model" value="" />
              </div>
            </label>
            <button
              class="flex shrink-0 items-center justify-center rounded-lg h-12 w-12 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-400">
              <span class="material-symbols-outlined">filter_list</span>
            </button>
          </div>
        </div>
        <!-- Product List -->
        <main class="flex-1 gap-5 px-4 pb-24">
          <!-- List Item 1 -->
          <div
            class="flex mb-6 gap-4 bg-white dark:bg-slate-800 p-3 justify-between rounded-xl border border-slate-200 dark:border-slate-700">
            <div class="flex items-center gap-4">
              <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-[70px] shrink-0"
                data-alt="Image of a silver smartphone"
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBlYCMiK7GNx7AeIlaNnKLMSoQ9F3kqmPIYKjlwOfdz_BQ40LwZ12cdGpfT4gN_ygCh-u434uvyvN5FCjKytj3LtNkVNKa9RBumBSBn75giTStAfJSgdoZaJ9KL9q68KGlCXVofiiHJb5e_7A-Ecpz9TYr3Ua_pyqU8g6pS702AdR7xd-o09owF-krKmnKSta-zjOysNeJHl3mbmUGZzpCY-nrQRIUzTrvSXRSk_CRthKK2ETIf4DriFwZDUwrIuuFuGBZYAvhKDREa");'>
              </div>
              <div class="flex flex-1 flex-col justify-center gap-1">
                <p class="text-slate-900 dark:text-white text-base font-bold leading-tight">iPhone 15 Pro - 256GB</p>
                <div class="flex items-center gap-1.5">
                  <span class="inline-block h-2 w-2 rounded-full bg-green-500"></span>
                  <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">Active</p>
                </div>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">$999.00 • 52 in stock</p>
              </div>
            </div>
            <div class="shrink-0 flex items-center">
              <button class="text-slate-500 dark:text-slate-400 flex size-8 items-center justify-center">
                <span class="material-symbols-outlined">more_vert</span>
              </button>
            </div>
          </div>
          <!-- List Item 2 -->
          <div
            class="flex mb-6 gap-4 bg-white dark:bg-slate-800 p-3 justify-between rounded-xl border border-slate-200 dark:border-slate-700">
            <div class="flex items-center gap-4">
              <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-[70px] shrink-0"
                data-alt="Image of a blue smartphone"
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAzzRVUEZamh5iVu5QMV8yvhQFfJr16w_O_FSkyod79G-wwS9dH0qb1EScMPONlvMfaI-IilqRzlUYLguB1uIPlRSAPT_QoWpiRcALx0WqOWI0o_BdJIGSF5S2sjWJKPTl4CY26eiSSXLuiaE8R0A1jCsvyfb7zgEcLifVvnZ0e0sw7u0Wk7PPggiPXExJoPQewl-FOZfnDl0ONNaK3Sf4TKkoEPznNEsYWPhmJNFzKEpEi7neRddJbYq8p3oVH9yl9RhBfG6kwrMiy");'>
              </div>
              <div class="flex flex-1 flex-col justify-center gap-1">
                <p class="text-slate-900 dark:text-white text-base font-bold leading-tight">Google Pixel 8 - 128GB</p>
                <div class="flex items-center gap-1.5">
                  <span class="inline-block h-2 w-2 rounded-full bg-yellow-500"></span>
                  <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">Low Stock</p>
                </div>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">$699.00 • 12 in stock</p>
              </div>
            </div>
            <div class="shrink-0 flex items-center">
              <button class="text-slate-500 dark:text-slate-400 flex size-8 items-center justify-center">
                <span class="material-symbols-outlined">more_vert</span>
              </button>
            </div>
          </div>
          <!-- List Item 3 -->
          <div
            class="flex mb-6 gap-4 bg-white dark:bg-slate-800 p-3 justify-between rounded-xl border border-slate-200 dark:border-slate-700">
            <div class="flex items-center gap-4">
              <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-[70px] shrink-0"
                data-alt="Image of a dark grey smartphone"
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAp4Y12SNR_wEdtxbRe0oLkbgQkvAPAMe0gVBk9rN4x6wCAe7FRfdu7su8JmPKlBE9JfL6l7EHRc7dAbPiSLsxJ8g-Czh7xf3R4f4hTrzppT7ao_nC019Ts5TjY5IDkhlkD2MSA2CtPBwMOiKIjlgRB-3XxMzrEIOXUZRE8NtVdJ93-wLiaBbV7rk1mUkPF-Wb52-LphsrGfYjmVvtG9MdEqrUoeOTQu_aMmmTgEgJJvK_GNH1pWf3_RuG160z9pvXG-iEnveCQXKC1");'>
              </div>
              <div class="flex flex-1 flex-col justify-center gap-1">
                <p class="text-slate-900 dark:text-white text-base font-bold leading-tight">Samsung S24 Ultra - 512GB
                </p>
                <div class="flex items-center gap-1.5">
                  <span class="inline-block h-2 w-2 rounded-full bg-red-500"></span>
                  <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">Out of Stock</p>
                </div>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">$1299.00 • 0 in stock</p>
              </div>
            </div>
            <div class="shrink-0 flex items-center">
              <button class="text-slate-500 dark:text-slate-400 flex size-8 items-center justify-center">
                <span class="material-symbols-outlined">more_vert</span>
              </button>
            </div>
          </div>
          <!-- List Item 4 -->
          <div
            class="flex mb-6 gap-4 bg-white dark:bg-slate-800 p-3 justify-between rounded-xl border border-slate-200 dark:border-slate-700">
            <div class="flex items-center gap-4">
              <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-[70px] shrink-0"
                data-alt="Image of a black smartphone"
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAV1J9jHQa_zobqiGPYFozJ-wgEf_3zHFgG_xPmTV2Q58GT_oNZyLY8gmy0y6hJCGkYQjJ1Y_M-CKbVef65YlydDasHLoxEjJ_hXLDGrjSY2lrfGPCWM4wNioNKMNVedL14VI0M8ZBF8YjpOycTu8wNo2ik0ZTx8U7ZndXq_XKX_yKZvuCAVBEwnmtxcJ4wM1H-vLGAAIixqBmBVsA9S6sOmXiJcmcl-N1LZpUW_JiXW4Q1mBBTf3dkhuB60aFXI3UqITMIWOj81uSG");'>
              </div>
              <div class="flex flex-1 flex-col justify-center gap-1">
                <p class="text-slate-900 dark:text-white text-base font-bold leading-tight">Nothing Phone (2) - 256GB
                </p>
                <div class="flex items-center gap-1.5">
                  <span class="inline-block h-2 w-2 rounded-full bg-green-500"></span>
                  <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">Active</p>
                </div>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">$599.00 • 35 in stock</p>
              </div>
            </div>
            <div class="shrink-0 flex items-center">
              <button class="text-slate-500 dark:text-slate-400 flex size-8 items-center justify-center">
                <span class="material-symbols-outlined">more_vert</span>
              </button>
            </div>
          </div>
        </main>
        {{-- <!-- Floating Action Button -->
        <div class="fixed bottom-6 right-6">
          <button class="flex h-16 w-16 items-center justify-center rounded-full bg-primary text-white shadow-lg">
            <span class="material-symbols-outlined !text-4xl">add</span>
          </button>
        </div> --}}
        </div>
    </div>
  </div>

@endsection