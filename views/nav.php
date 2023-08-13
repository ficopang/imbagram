<?php
?>
<div class="pb-32">
    <nav class="border-b border-opacity-25 lg:border-none">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
            <div
                class="relative h-16 flex items-center justify-between lg:border-b lg:border-slate-200 lg:border-opacity-25">
                <div class="px-2 flex items-center lg:px-0">
                    <a href="index.php" class="flex-shrink-0">
                        <img class="block h-8" src="../assets/Imbagram.png" alt="imbagram">
                    </a>
                </div>
                <div class="flex-1 px-2 flex justify-center lg:ml-6 lg:justify-center">
                    <div class="max-w-lg w-full lg:max-w-xs">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative text-gray-400 focus-within:text-gray-600">
                            <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="search"
                                class="block w-full bg-white py-2 pl-10 pr-3 border border-transparent rounded-md leading-5 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-sky-600 focus:ring-white focus:border-white sm:text-sm"
                                placeholder="Search" type="search" name="search">
                        </div>
                    </div>
                </div>
                <div class="block lg:ml-4">
                    <div class="flex items-center">
                        <!-- IF LOGGED IN -->
                        <?php if (isset($_SESSION['userId'])) {
                            $detail = getUserDetail($_SESSION['userId']);
                            $data = $detail->fetch_assoc();
                        ?>
                        <div class="ml-3 relative flex-shrink-0">
                            <div>
                                <button id="btnProfile" type="button"
                                    class="bg-sky-600  object-cover rounded-full flex text-sm text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-sky-600 focus:ring-white"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="object-cover rounded-full h-8 w-8"
                                        src="../uploads/<?= $data['profilePicture'] ?>" alt="">
                                </button>
                            </div>

                            <div id="panel"
                                class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1">
                                <a href="/views/profile.php?id=<?= $_SESSION['userId'] ?>"
                                    class="hover:bg-gray-100 block py-2 px-4 text-sm text-gray-700" role="menuitem"
                                    tabindex="-1" id="user-menu-item-2">
                                    See profile
                                </a>
                                <a href="/views/postContent.php"
                                    class="hover:bg-gray-100 block py-2 px-4 text-sm text-gray-700" role="menuitem"
                                    tabindex="-1" id="user-menu-item-2">
                                    Post content
                                </a>
                                <a href="/controllers/logoutController.php"
                                    class="hover:bg-gray-100 block py-2 px-4 text-sm text-gray-700" role="menuitem"
                                    tabindex="-1" id="user-menu-item-2">
                                    Sign out
                                </a>
                            </div>
                        </div>
                        <?php } else { ?>
                        <!-- IF NOT LOGGED IN -->
                        <div class=" mt-4 flex sm:mt-0 sm:ml-4">
                            <a href="login.php"
                                class="order-1 ml-3 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 sm:order-0 sm:ml-0">
                                Log in
                            </a>
                            <a href="register.php"
                                class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 sm:order-1 sm:ml-3">
                                Register
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
<script>
$('#btnProfile').click(function(e) {
    $('#panel').toggle()
});
$('#search').keypress(function(e) {
    if (e.which == 13) {
        var data = $('#search').val();
        window.location = 'search.php?q=' + data;
        return false; //<---- Add this line
    }
});
</script>