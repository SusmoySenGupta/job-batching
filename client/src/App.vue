<template>
  <div class="dark antialiased">
    <div class="relative min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="w-full absolute top-0 flex justify-center">
            <p class="pt-2 text-3xl font-light dark:text-gray-100">Job Batching w/ Laravel and VueJs</p>
        </div>
        <div class="absolute flex flex-col items-center justify-center gap-4 inset-0">
            <!-- <div class="w-96 h-64 mt-2 flex items-center border-4 border-dashed rounded-lg"> -->
            <!-- </div> -->
            <section class="" v-if="!batchDetails">
                <form @submit.prevent="submit()" method="post" enctype="multipart/form-data" class="flex flex-col border border-dashed py-2 px-4">
                    <caption class=" mb-6 text-gray-100">Choose a file to upload</caption>
                    <div class="flex items-center ">
                        <div class="flex w-full h-full items-center justify-center" >
                        <input type="file" name="file" class="w-52 px-0 text-white cursor-pointer" ref="file" v-on:change="handleFileUpload()">
                        </div>
                        <div class="">
                            <button type="submit" class="ml-6 px-3 py-1.5 bg-purple-500 rounded text-gray-100 font-semibold hover:bg-purple-700 focus:outline-none focus:ring-2 ">Upload</button>
                        </div>
                    </div>
                </form>
            </section>
            <section v-else>
                <div class="text-gray-200 mb-2">
                    Uploading...
                </div>
                <div class="w-96 flex items-center gap-4">
                    <div class="w-5/6 border h-6  rounded-full overflow-hidden">
                        <div class="h-full bg-green-500 transition ease-in duration-75" :style="`width: ${progress}%`"></div>
                    </div>
                    <div class="w-1/6 text-lg text-center font-semibold text-gray-100"> {{ progress }}% </div>
                </div>
            </section>
        </div>
    </div>
  </div>
</template>

<script>
import {ref, onMounted} from 'vue';
export default {
    name: 'App',
    components: {  },
    setup(){
        const file = ref("");
        const api_url = "http://127.0.0.1:8000/api";
        const batchDetails = ref(null);
        const progress = ref(0);
        const getDetails = ref(null);
        let count = 0;
        
        const handleFileUpload = () => {
            file.value = file.value.files[0];
        };
        function submit(){
            if(!file.value) return;
            const formData = new FormData();
            formData.append('file', file.value);

            fetch(`${api_url}/sales`, {method: 'post', body: formData})
            .then((response) => response.json())
            .then((data) => {
                batchDetails.value = data;
                if(batchDetails.value && progress.value < 100) 
                    getBatchDetails(batchDetails.value.id);
            });
        }
        function getBatchDetails(id = null){
            getDetails.value = setInterval(() => {
                if(count == 5 && progress.value ==0){
                    batchDetails.value = null;
                    progress.value = 0;
                    clearInterval(getDetails.value);
                    alert("Something went wrong");
                    return 0;
                }
                if(progress.value < 100){
                    fetch(`${api_url}/get-batch-details/${id}`)
                    .then((response) => response.json())
                    .then((data) => progress.value = data.progress);
                } else {
                    batchDetails.value = null;
                    progress.value = 0;
                    file.value = "";
                    clearInterval(getDetails.value);
                } count++;
                
            }, 1000);
        }

       onMounted(() => {
            fetch(`${api_url}/get-batch-progress`)
                .then((response) => response.json())
                .then((data) => {
                   if(data){
                        batchDetails.value = data;
                        getBatchDetails(batchDetails.value.id);
                   }
                });
       })

        return {file, batchDetails, progress, submit, handleFileUpload};
    },


}
</script>

<style>

</style>
