<x-layouts.app-layout>
    <style>
        .nav_routes {
            display: none !important;
        }

        .search_routes {
            display: flex;
        }

        .skeleton {
            width: 60%;
        }

        .posts {
            align-items: center
        }

        .post_card {
            width: 85%;
        }

        @media screen and (max-width: 880px) {
            .nav_routes {
                display: flex !important;
            }
        }
    </style>
    <livewire:search.search-page />
</x-layouts.app-layout>
