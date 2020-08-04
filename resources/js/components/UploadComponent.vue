<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">File upload Vue</div>

                    <div class="card-body">
                        <form action="" @submit.prevent="uploadFiles" method="post" enctype="multipart/form-data">                            
                            <input 
                                @change="selectedFiles"
                                type="file" 
                                multiple
                                class="form-control" />
                            <br />
                            <div style="width: 100%; height: 5px; background-color:#eee;">
                                <div style="height: 5px; background-color:green;" :style="`width:${progress}%;`"></div>
                            </div>
                            <br />
                            <input type="submit" :disabled="isUploading" class="btn btn-primary" value="Upload">
                        </form>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                files: [],
                progress: 0,
                isUploading: false
            }
        },
        props: {
            url: {
                required: true,
                type: String
            }
        },
        
        methods: {
            async uploadFiles () {
                if (this.files.length === 0) {
                    return;
                }

                let form = new FormData();

                Array.from(this.files).forEach((file, index) => {
                    form.append(`files[${index}]`, file);
                });

                this.isUploading = true

                await axios.post(this.url, form, {                
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: this.handleUploadProgress
                });

                this.progress = 0;    
                this.isUploading = false            
            },

            selectedFiles(event) {
                this.files = event.target.files                                
            },

            handleUploadProgress(event) {
                this.progress = parseInt(Math.round((event.loaded / event.total) * 100));
            },
        },
    }
</script>
