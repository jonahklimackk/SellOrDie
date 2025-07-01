<div class="mb-8 w-full flex justify-center">
    <nav class="flex space-x-4 justify-center">
        <a href="{{ url('/affiliate/dashboard') }}"
           class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('affiliate/dashboard') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            Dashboard
        </a>      
        <a href="{{ url('/affiliate/campaigns') }}"
           class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('affiliate/campaigns') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            Campaigns
        </a>
        <a href="{{ url('/affiliate/tools') }}"
           class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('affiliate/tools') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            Marketing Tools
        </a>
        <a href="{{ url('/affiliate/sales') }}"
           class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('affiliate/sales') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            Sales
        </a>
        <a href="{{ url('/affiliate/commission') }}"
           class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('affiliate/commission') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            Commission
        </a>
        <a href="{{ url('/downline/1') }}"
           class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('downeline/1') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            Personal Referrals
        </a>        
    </nav>
</div>