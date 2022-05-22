<div class="container mx-auto">
    {{ $titolo }}
    @yield('alert-message')
    <div class="mb-40 card tabella">
        <section class="container mx-auto p-6 font-mono">
            <div class="w-full overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            {{ $colonne }}
                        </tr>
                        </thead>
                        <tbody>
                        {{ $righe }}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
