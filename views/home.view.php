<?php
    require_once "partials/header.php";
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

<?php require "partials/footer.php"; ?>

<script>
    const pageSize = 3;

    function fetchTrendingImages(query = "", pageNumber = 1) {
        const url = query ?
            `/php-prj/controllers/search-query/search-trending-images.php?query=${encodeURIComponent(query)}&pageSize=${pageSize}&pageNumber=${pageNumber}` :
            `/php-prj/controllers/pagination/pagination.php?pageSize=${pageSize}&pageNumber=${pageNumber}`;

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                const {
                    paginatedData,
                    pageCount
                } = response.data;
                renderTrendingImages(paginatedData);
                generatePageButton(pageCount, pageNumber, query);
            },
            error: function(error) {
                console.error("Error fetching data:", error);
            },
        });
    }

    function renderTrendingImages(images) {
        const container = document.getElementById("trendingImages");
        container.innerHTML = "";

        if (!images || images.length === 0) {
            container.innerHTML = "<p>No results found.</p>";
            return;
        }

        images.forEach(image => {
            const card = document.createElement("div");
            card.className =
                "max-w-sm bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 min-w-[400px] min-h-[430px]";
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
                    <a href="/php-prj/views/components/detailed-data.php?id=${encodeURIComponent(image.id)}" 
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            `;
            container.appendChild(card);
        });
    }

    function generatePageButton(pageCount, currentPage, query = "") {
        const paginationList = document.getElementById("paginationList");
        paginationList.innerHTML = "";

        const createPageButton = (label, isDisabled, onClick) => {
            const button = document.createElement("li");
            button.className = `page-item ${isDisabled ? "disabled" : ""}`;
            button.innerHTML = `<a class="page-link" href="#">${label}</a>`;
            if (!isDisabled) button.addEventListener("click", onClick);
            return button;
        };

        paginationList.appendChild(createPageButton("Previous", currentPage === 1, () => fetchTrendingImages(query,
            currentPage - 1)));

        for (let i = 1; i <= pageCount; i++) {
            const isActive = i === currentPage;
            const pageButton = createPageButton(i, isActive, () => fetchTrendingImages(query, i));
            if (isActive) pageButton.classList.add("active");
            paginationList.appendChild(pageButton);
        }

        paginationList.appendChild(createPageButton("Next", currentPage === pageCount, () => fetchTrendingImages(query,
            currentPage + 1)));
    }

    document.getElementById("searchInput").addEventListener("input", (e) => {
        fetchTrendingImages(e.target.value.trim());
    });

    fetchTrendingImages();
</script>