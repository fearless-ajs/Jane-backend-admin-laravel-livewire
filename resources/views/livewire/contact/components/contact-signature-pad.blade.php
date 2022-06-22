<div x-data="signaturePad()" class="relative shadow-xl rounded-lg p-6 flex flex-col gap-4" style="color: white;">


    @if(!$invoice->contactSignature)
    <p class="text-xl font-semibold text-gray-700 flex items-center justify-between" style="text-align: center !important;"><span>Sign here</span> </p>

    <div>
        <canvas x-ref="signature_canvas" class="border rounded shadow">

        </canvas>
    </div>

        <div style="text-align: center;" class="mt-1">
            <button  x-on:click="upload" wire:loading.remove wire:target="submit" class="btn btn-outline-primary" style="margin-right: 10px;">
                Submit signature
            </button>
            <button  x-on:click="clear" wire:loading.remove wire:target="submit" class="btn btn-outline-danger">
                Clear
            </button>
            <button wire:loading wire:target="submit" class="btn btn-outline-primary mt-1 w-100 mb-75"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>

        </div>
    @else
        <p class="text-xl font-semibold text-gray-700 flex items-center justify-between text-success" style="text-align: center !important;"><span>Signature</span> </p>

        <div>
            <img src="{{$invoice->contactSignature->SignatureImage}}" />
        </div>
        <p style="text-align: center;" class="mt-2">Signed: {{ \Carbon\Carbon::parse($invoice->contactSignature->created_at)->translatedFormat(' j F Y')}}</p>
    @endif

</div>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>

    //        const canvas = document.getElementById('signature_canvas');

    document.addEventListener('alpine:init', () => {
        Alpine.data('signaturePad', () => ({
            signaturePadInstance: null,
            init(){
                this.signaturePadInstance = new SignaturePad(this.$refs.signature_canvas);
            },
            upload(){
                @this.set('signature', this.signaturePadInstance.toDataURL('image/png'))
                @this.call('submit')
            },
            clear(){
                this.signaturePadInstance.clear()
            }
        }))
    })

</script>
