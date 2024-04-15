<x-filament-panels::page>
    <div>




    <form wire:submit="setCurrency">
        {{ $this->form }}
        <div style="padding:30px 0px;">
                <button
                wire:loading.attr="disabled"
                wire:confirm='Are you sure'
                wire:confirm="Are you sure you want to share fund to this account?"
            > 
                    <span wire:loading.remove
                        style="background:#059669; color:#ffffff; padding:7px 11px; border-radius:3px;"
                    >Update</span>
                    <span wire:loading
                        style="background:#059669; color:#ffffff; cursor:no-drop; opacity:0.6; padding:7px 11px; border-radius:3px;"
                    >
                    processing...</span>
            </button>
    </div>
    </form>
    
    <x-filament-actions::modals />


    @assets

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @endassets

    @script
    <script>
        document.addEventListener('alert', (event) => {
            let alertData = event.detail;


            Swal.fire({
            title: alertData.title,
            text: alertData.text,
            icon: alertData.type,
            confirmButtonText: alertData.button
            })

        });
        
    </script>

    @endscript
</div>
</x-filament-panels::page>
