<link rel="stylesheet" href="../comp/header.css">
<script src="https://cdn.tailwindcss.com"></script>

<?php 
echo '<header class="shadow-gray-200 z-50 w-full md:w-[100vw] shadow-md mt-0 h-15 flex items-center bg-[#2980b9]">
<nav class="w-full flex justify-between items-center font-semibold">
    <a href="../index.php">
    <div class="flex md:mx-4 md:mx-10 items-center">
        <div class="mx-1"><span class="font-bold text-xl text-white">The</span>
            <div class="text-2xl md:text-4xl text-white">B<span class="text-base md:text-xl text-white">ank</span></div>
            <div class="h-[1px] mt-[2px] w-8 md:w-12 bg-white animate-pulse ease-in-out duration-75 delay-75"> </div>
        </div>
        <div class="text-lg md:text-xl text-white mt-2"><span class="text-2xl md:text-4xl text-white">S</span>ystem</div>
    </div>
    </a>

    <div class="navigation z-50 transition-all duration-300 ease-in-out delay-0 md:static md:py-0 left-[-110%] md:flex md:justify-end absolute top-0 md:pt-0 pt-[30px] bg-[#2980b9] md:h-auto h-[100%] md:block ml-auto text-white">
        <ul class="flex flex-col md:flex-row md:justify-end md:item-center">
            <li class="px-10 md:m-0 mt-3 md:px-10 "><a href="../index.php">Home</a></li>
            <li class="px-10 md:m-0 mt-10 md:px-10"><a href="../pages/show_customers.php">Customers Info</a></li>
            <li class="px-10 md:m-0 mt-10 md:px-10"><a href="../pages/transfer.php">Money Transfer</a></li>
            <li class="px-10 md:m-0 mt-10 md:px-10"><a href="../pages/transfer_hist.php">Transfer History</a></li>
        </ul>
    </div>

    <!-- Hamburger Menu for Mobile -->
    <div class="block md:hidden mr-4">
        <button id="hamburger" class="text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>
</nav>
</header>';

echo '<script>
document.getElementById("hamburger").addEventListener("click", function() {
    var nav = document.querySelector(".navigation");
    nav.classList.toggle("left-0");
});
</script>';
?>
