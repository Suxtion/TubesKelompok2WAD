<aside id="logo-sidebar"
  class="w-64 h-screen pt-24 bg-white border-r border-gray-200 hidden sm:block"
  aria-label="Sidebar">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
    <ul class="space-y-2 font-medium">
      <!-- Menu Admin -->
      <li class="mt-4 font-semibold text-gray-500 uppercase">Admin</li>
      <li>
        <a href="{{ route('admin.reservasi.index') }}"
           class="flex items-center p-2 {{ Request::is('admin/reservasi*') ? 'active text-white bg-green-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
               aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 3h14v2H3V3Zm0 4h14v2H3V7Zm0 4h14v2H3v-2Zm0 4h14v2H3v-2Z" />
          </svg>
          <span class="ms-3">Reservasi</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.peminjaman.index') }}"
           class="flex items-center p-2 {{ Request::is('admin/peminjaman*') ? 'active text-white bg-green-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
               aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M4 4h12v2H4V4Zm0 4h12v2H4V8Zm0 4h12v2H4v-2Z" />
          </svg>
          <span class="ms-3">Peminjaman</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.penyedia-catering.index') }}"
           class="flex items-center p-2 {{ Request::is('admin/penyedia-catering*') ? 'active text-white bg-green-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
               aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm3 11H7v-2h6v2Zm0-4H7V6h6v3Z" />
          </svg>
          <span class="ms-3">Penyedia Catering</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.event-organizers.index') }}"
           class="flex items-center p-2 {{ Request::is('admin/event-organizers*') ? 'active text-white bg-green-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
               aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M4 4h12v2H4V4Zm0 4h12v2H4V8Zm0 4h12v2H4v-2Z" />
          </svg>
          <span class="ms-3">Event Organizers</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.booking-requests.index') }}"
           class="flex items-center p-2 {{ Request::is('admin/booking-requests*') ? 'active text-white bg-green-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
               aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm1 12H9v-2h2v2Zm0-4H9V6h2v4Z" />
          </svg>
          <span class="ms-3">Booking Requests</span>
        </a>
      </li>
    </ul>
  </div>
</aside>