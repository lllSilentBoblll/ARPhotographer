<template>
    <div class="container">

       <div class="progress" style="height: 40px">
           <div class="progress-bar" role="progressbar" :style="{width: uploadProgress + '%'}">{{ currentUploadingFile }}%</div>
       </div>

        <hr>

        <input type="file" name="photo" multiple="" @change="fileInputChange">

        <hr>

        <div class="row">

            <div class="col-sm-6">
                <h3 class="text-center">Фото в очереди ({{ photosToUpload.length }})</h3>
                <ul class="list-group">
                    <li class="list-group-item" v-for="file in photosToUpload">
                        {{ file.name }} : {{ file.type }}
                    </li>
                </ul>
            </div>

            <div class="col-sm-6">
                <h3 class="text-center">Загруженные фото ({{ photosUploaded.length }})</h3>
                <ul class="list-group">
                    <li class="list-group-item" v-for="file in photosUploaded">
                        {{ file.name }} : {{ file.type }}
                    </li>
                </ul>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                photosToUpload: [],
                photosUploaded: [],
                uploadProgress: 0,
                currentUploadingFile: ''

            }
        },
        methods: {
            async fileInputChange() {
                let files = Array.from(event.target.files);

                this.photosToUpload = files.slice();

                for (let item of files) {
                    await this.uploadFile(item);
                }
            },
            async uploadFile() {
                let form = new FormData();
                form.append('photo', item);

                await axios.post('',form, {
                    onUploadProgress: (itemUpload) => {
                        this.uploadProgress = Math.round((itemUpload.loaded / itemUpload.total) * 100);
                        this.currentUploadingFile = item.name + ' ' + this.uploadProgress;
                    }
                })
                    .then(response => {
                        this.uploadProgress = 0;
                        this.currentUploadingFile = '';
                        this.photosUploaded.push(item);
                        this.photosToUpload.slice(item, 1);
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    }
</script>
