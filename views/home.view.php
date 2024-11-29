<?php
$pageTitle = "Home page";
require "partials/head.php";
require "partials/nav.php";
?>

<main>
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <h1 class="text-center font-bold text-3xl mt-3">Hello. Welcome to the home page!</h1>
        <input type="text" id="searchInput" placeholder="Search for something">
    </div>


    <div class="max-w-screen-xl flex flex-wrap items-center gap-3 mx-auto p-4" id="trendingImages"></div>

    <nav class="flex justify-center items-center py-5">
        <ul class="pagination" id="paginationList"></ul>
    </nav>

</main>

<?php require "partials/footer.php" ?>

<script>
    function fetchTrendingImages(pageSize, pageNumber) {
        $.ajax({
            url: `/php-prj/controllers/pagination/pagination.php?pageSize=${pageSize}&pageNumber=${pageNumber}`,
            type: "GET",
            success: function(response) {
                const {
                    data,
                    pageCount
                } = response.data;
                renderTrendingImages(data);
                generatePageButton(pageCount, pageNumber);
            },
            error: function(error) {
                console.error("Error fetching data:", error);
            },
        });
    }

    document.getElementById("searchInput").addEventListener("input", (e) => {
        const query = e.target.value;

        $.ajax({
            url: `/php-prj/controllers/search-query/search-trending-images.php?query=${encodeURIComponent(query)}`,
            type: "GET",
            success: function(response) {
                renderTrendingImages(response.data);
            },
            error: function(response) {
                toastr.error("Error response:", response);
            }
        });
    });

    function renderTrendingImages(images) {
        const container = document.getElementById("trendingImages");
        container.innerHTML = "";

        if (!images || images.length === 0) {
            container.innerHTML = "<p>No results found.</p>";
            return;
        }

        images.forEach((image) => {
            const card = document.createElement("div");
            card.className =
                "max-w-sm bg-white border border-gray-200 rounded-lg  dark:bg-gray-800 dark:border-gray-700 min-w-[400px] min-h-[430px]";
            card.innerHTML = `
            <a href="#">
                <img class="rounded-t-lg w-full object-cover h-[220px]" 
                    src="${image.imageUrl || '/path/to/default-image.jpg'}" 
                    alt="${image.Title || 'Default Title'}" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        ${image.Title || 'Untitled'}
                    </h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    ${image.Description || 'No description available.'}
                </p>
                <a href="/php-prj/views/components/detailed-data.php?id=${encodeURIComponent(
                    image.id
                )}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        `;
            container.appendChild(card);
        });
    }

    function generatePageButton(pageCount, currentPage) {
        const paginationList = document.getElementById("paginationList");
        paginationList.innerHTML = ""; // Clear existing pagination

        // // Create "Previous" button
        // const prevItem = document.createElement("li");
        // prevItem.className = `page-item ${currentPage === 1 ? "disabled" : ""}`;
        // prevItem.innerHTML = `<a class="page-link" href="#">Previous</a>`;
        // prevItem.addEventListener("click", () => {
        //     if (currentPage > 1) fetchTrendingImages(3, currentPage - 1);
        // });
        // paginationList.appendChild(prevItem);

        // Create page number buttons
        for (let i = 1; i <= pageCount; i++) {
            const paginationItem = document.createElement("li");
            paginationItem.className = `page-item ${i === currentPage ? "active" : ""}`;

            paginationItem.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            paginationItem.addEventListener("click", () => fetchTrendingImages(3, i));
            paginationList.append(paginationItem);
        }

        // // Create "Next" button
        // const nextItem = document.createElement("li");
        // nextItem.className = `page-item ${currentPage === pageCount ? "disabled" : ""}`;
        // nextItem.innerHTML = `<a class="page-link" href="#">Next</a>`;
        // nextItem.addEventListener("click", () => {
        //     if (currentPage < pageCount) fetchTrendingImages(3, currentPage + 1);
        // });
        // paginationList.appendChild(nextItem);
    }




    fetchTrendingImages(3, 1)
</script>