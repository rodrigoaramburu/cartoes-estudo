<div class="mt-2" x-data="editor()">
    <label for="{{$name}}" class="blcok">{{$label}}</label>
    
    <textarea x-model="content" name="{{$name}}" id="{{$name}}" class="w-full hidden">{{old('front')}}</textarea>

    <div class="flex gap-1 mb-1 text-gray-700 text-lg">
        <button type="button" @click="format('bold')" class="border border-gray-400 p-1 rounded" title="Negrito">
            <svg class="w-5 h-5 text-gray-700" fill="none" height="256" viewBox="0 0 256 256" width="256" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M56 40V216H148C176.719 216 200 192.719 200 164C200 147.849 192.637 133.418 181.084 123.88C187.926 115.076 192 104.014 192 92C192 63.2812 168.719 40 140 40H56ZM88 144V184H148C159.046 184 168 175.046 168 164C168 152.954 159.046 144 148 144H88ZM88 112V72H140C151.046 72 160 80.9543 160 92C160 103.046 151.046 112 140 112H88Z" fill="currentColor" fill-rule="evenodd"/></svg>
        </button>
        <button type="button" @click="format('italic')" class="border border-gray-400 p-1 rounded" title="Itálico">
            <svg class="w-5 h-5 text-gray-700" fill="none" height="256" viewBox="0 0 256 256" width="256" xmlns="http://www.w3.org/2000/svg"><path d="M202 40H84V64H126.182L89.8182 192H54V216H172V192H129.818L166.182 64H202V40Z" fill="currentColor"/></svg>
        </button>
        <button type="button" @click="format('underline')" class="border border-gray-400 p-1 rounded" title="Sublinhado">
            <svg class="w-5 h-5 text-gray-700" fill="none" height="256" viewBox="0 0 256 256" width="256" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M88 40H60V108.004C60 145.56 90.4446 176.004 128 176.004C165.555 176.004 196 145.56 196 108.004V40H168V108C168 130.091 150.091 148 128 148C105.909 148 88 130.091 88 108V40ZM204 216V192H52V216H204Z" fill="currentColor" fill-rule="evenodd"/></svg>
        </button>
        <button type="button" @click="format('formatBlock','h1')" class="border border-gray-400 p-1 rounded font-bold">H1</button>
        <button type="button" @click="format('formatBlock','h2')" class="border border-gray-400 p-1 rounded font-bold">H2</button>
        <button type="button" @click="format('formatBlock','h3')" class="border border-gray-400 p-1 rounded font-bold">H3</button>
        <button type="button" @click="format('insertUnorderedList')" class="border border-gray-400 p-1 rounded" title="Lista">
            <svg class="w-5 h-5" fill="none" height="256" viewBox="0 0 256 256" width="256" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M56 80C64.8366 80 72 72.8366 72 64C72 55.1634 64.8366 48 56 48C47.1634 48 40 55.1634 40 64C40 72.8366 47.1634 80 56 80ZM96 52H216V76H96V52ZM216 116H96V140H216V116ZM216 180H96V204H216V180ZM72 128C72 136.837 64.8366 144 56 144C47.1634 144 40 136.837 40 128C40 119.163 47.1634 112 56 112C64.8366 112 72 119.163 72 128ZM56 208C64.8366 208 72 200.837 72 192C72 183.163 64.8366 176 56 176C47.1634 176 40 183.163 40 192C40 200.837 47.1634 208 56 208Z" fill="currentColor" fill-rule="evenodd"/></svg>
        </button>
        <button type="button" @click="format('insertOrderedList')" class="border border-gray-400 p-1 rounded" title="Lista Numerada">
            <svg class="w-5 h-5 text-gray-700" fill="none" height="256" viewBox="0 0 256 256" width="256" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M52.9999 44H62.9999V79H69.9999V88H45.9999V79H52.9999V55L49 59L44 54L52.9999 44ZM96 52H216V76H96V52ZM216 116H96V140H216V116ZM215 181H95V205H215V181ZM41.7135 173.528C46.2812 171.177 50.9115 170 56.5535 170C60.5469 170 64.5605 170.873 67.7487 172.919C71.0751 175.054 73.5911 178.59 73.5911 183.295C73.5911 186.914 72.1768 189.68 70.2565 191.65C72.3134 193.7 74 196.638 74 200.5C74 205.634 70.6737 209.119 67.4762 211.049C64.2275 213.01 60.2143 214 56.5534 214C50.8106 214 44.9841 211.937 40 209L44.8572 201C48.372 203.071 52.5036 204 56.5534 204C58.6819 204 61.2299 203.465 62.8286 202.5C63.8915 201.858 64.1808 201.142 64.2591 200.781C64.3393 200.411 64.3813 199.878 64.2858 199.5C64.1511 198.967 63.7345 198.211 62.8286 197.5C61.956 196.815 60.9838 196.658 60.0529 196.507C59.8877 196.481 59.7237 196.454 59.5619 196.425C58.4651 196.227 57.0851 196.203 55.3575 196.272C53.4671 196.422 51.5999 196.498 49.9391 196.5L49.8677 196.5V187L49.9415 187C50.844 186.997 51.724 186.948 52.747 186.891H52.7471L52.7476 186.891L52.7486 186.891C53.363 186.856 54.0292 186.819 54.7829 186.787C56.4639 186.649 58.1404 186.445 59.6131 186.179C60.9396 185.94 62.2071 185.492 63.0252 184.89C63.3955 184.618 63.5861 184.378 63.6873 184.195C63.7738 184.038 63.8768 183.781 63.8768 183.295C63.8768 182.705 63.683 182.094 62.6094 181.405C61.3975 180.627 59.3209 180 56.5535 180C52.4028 180 49.2617 180.823 46.0579 182.472L41.7135 173.528ZM56.7778 116C54.723 116 52.9572 116.493 50.8895 117.524C49.2092 118.361 47.9296 119.106 46.7872 120.107L40.7684 112.4C42.826 110.599 44.9508 109.431 46.8661 108.476C49.8983 106.965 53.04 106 56.7778 106C60.9203 106 64.9801 107.043 68.1629 109.201C71.3983 111.394 74 114.999 74 119.756C74 128.011 68.1559 133.253 61.2763 134.026C59.8842 134.183 58.0513 134.419 56.3523 134.708C54.5163 135.02 53.2742 135.324 52.7979 135.518C50.7126 136.366 50.0966 137.121 49.8871 137.461C49.6701 137.814 49.4444 138.436 49.4444 140H74V150H40V140C40 137.564 40.3222 134.686 41.9746 132.001C43.6347 129.304 46.21 127.484 49.4118 126.182C50.921 125.569 53.0728 125.137 54.8557 124.834C56.7756 124.508 58.7865 124.25 60.2793 124.082C63.2596 123.747 64.5556 121.989 64.5556 119.756C64.5556 119.269 64.359 118.496 63.0703 117.622C61.729 116.713 59.5388 116 56.7778 116Z" fill="currentColor" fill-rule="evenodd"/></svg>
        </button>
        <button type="button" @click="format('justifyLeft')" class="border border-gray-400 p-1 rounded" title="Alinha a direita">
            <svg class="w-5 h-5 text-gray-700" fill="none" height="256" viewBox="0 0 256 256" width="256" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M216 41H40V65H216V41ZM40 91H168V115H40V91ZM216 141H40V165H216V141ZM168 191H40V215H168V191Z" fill="currentColor" fill-rule="evenodd"/></svg>
        </button>
        <button type="button" @click="format('justifyCenter')" class="border border-gray-400 p-1 rounded" title="Centralizar">
            <svg class="w-5 h-5 text-gray-700" fill="none" height="256" viewBox="0 0 256 256" width="256" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M216 41H40V65H216V41ZM68 91H188V115H68V91ZM216 141H40V165H216V141ZM188 191H68V215H188V191Z" fill="currentColor" fill-rule="evenodd"/></svg>
        </button>
        <button type="button" @click="format('justifyRight')" class="border border-gray-400 p-1 rounded">
            <svg class="w-5 h-5 text-gray-700" fill="none" height="256" viewBox="0 0 256 256" width="256" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M216 41H40V65H216V41ZM88 91H216V115H88V91ZM216 141H40V165H216V141ZM216 191H88V215H216V191Z" fill="currentColor" fill-rule="evenodd"/></svg>
        </button>
    </div>

    <iframe x-ref="wysiwyg" class="border border-gray-500 w-full h-36 overflow-y-auto"></iframe>
    
    @error($name)
        <div class="text-red-600">{{$message}}</div>
    @enderror
</div>