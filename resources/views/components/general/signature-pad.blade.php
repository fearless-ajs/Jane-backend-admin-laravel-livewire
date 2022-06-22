<div x-data="ContactSignaturePad(@entangle($attributes->wire('model')))">
    <p class="text-xl font-semibold text-gray-700 flex items-center justify-between" style="text-align: center !important;"><span>Sign here</span> </p>
    <div>
        <canvas id="signature_canvas" class="border rounded shadow">

        </canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('ContactSignaturePad', (value) => ({
            signaturePadInstance: null,
            value: value,
            init(){
                this.signaturePadInstance = new SignaturePad(this.$refs.signature_canvas);
                this.signaturePadInstance.addEventListener("endStroke", ()=>{
                    this.value = this.signaturePadInstance.toDataURL('image/png');
                });
            },
        }))
    })
</script>
