@extends('layout')

@section('title', "Products")

@section('main')

<div id="products_app">


    <h1>Products</h1>

    <hr class="col-3 col-md-2 mb-5">

    <div>

        <div class="form-group mb-4">
            <label>Image</label>
            <div v-if="form.image==null" class="upload_box">
                <span>Choose image <i class="fas fa-upload"></i></span>
                <input type="file" @change="uploadImage" name="image" accept="image/*" class="form-control-file">
            </div>
            <div v-else class="image_box">
                <div class="remove_img" @click="form.image=null"><i class="fas fa-close"></i></div>
                <img :src="'/storage/'+form.image">
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-6 mb-2">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter name" :class="errors.name ? 'is-invalid' : ''" v-model="form.name">
                <div class="invalid-feedback">
                    @{{ errors.name?.join('<br/>') }}
                </div>
            </div>
            <div class="form-group col-6 mb-2">
                <label>Price</label>
                <input type="number" class="form-control" placeholder="Enter price" :class="errors.price ? 'is-invalid' : ''" v-model="form.price">
                <div class="invalid-feedback">
                    @{{ errors.price?.join('<br/>') }}
                </div>
            </div>
        </div>

        <div class="row">

            <div class="form-group col-6 mb-4">
                <label>Description</label>
                <textarea class="form-control" :class="errors.description ? 'is-invalid' : ''" rows="3" v-model="form.description"></textarea>
                <div class="invalid-feedback">
                    @{{ errors.description?.join('<br/>') }}
                </div>
            </div>

            <div class="form-group col-6 mb-2">
                <label>Category</label>
                <select class="form-control" :class="errors.category_id ? 'is-invalid' : ''" v-model="form.category_id">
                    <option :value="null">Choose category</option>
                    <option v-for="c of categories" :value="c.id">@{{c.name}}</option>
                </select>
                <div class="invalid-feedback">
                    @{{ errors.category_id?.join('<br/>') }}
                </div>
            </div>
        </div>

        <div class="mb-2" style="display: flex;align-items: center;">
            <button :disabled="saveLoader" class="btn btn-primary mx-2" @click="save">Save</button>
            <button :disabled="saveLoader" class="btn btn-secondary mx-2" @click="cancel">Cancel</button>

            <div v-if="saveLoader" class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        

        
    </div>

    <div class="row mb-2">
        <div class="col-sm-2">
            <select class="form-select" style="padding: 0px 35px 0px 5px; width: fit-content;"
                    v-model="pagination.per_page" @change="pagination.page=1;loadData();">

                <option :value="20">20</option>
                <option :value="50">50</option>
                <option :value="100">100</option>
                <option :value="250">250</option>
                <option :value="500">500</option>

            </select>
        </div>
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>created at</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="loader">
                <td style="text-align: center;" colspan="7">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span> 
                    </div>
                </td>
            </tr>
            <tr v-for="d of data">
                <th>@{{d.id}}</th>
                <td><img width="50" :src="d.image?('/storage/'+d.image):'/img/no-image-icon.png'"></td>
                <td>@{{d.name}}</td>
                <td>@{{d.description}}</td>
                <td>@{{d.price}}</td>
                <td>@{{d.category}}</td>
                <td>@{{toDate(d.created_at)}}</td>
                <td>
                    <button @click="edit(d)" class="btn p-0 m-0 me-2" title="Modifier"><i class="fas fa-edit text-success"></i></button>
                    <button @click="deleteProduct(d.id)" class="btn p-0 m-0 me-2" title="Supprimer"><i class="fas fa-trash text-danger"></i></button>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="row mb-2" style="justify-content: right;">
        Page: 
        <button type="button" class="btn btn-primary btn-sm mx-2" style="width: fit-content" 
            :disabled="pagination.page==1" @change="pagination.page--;loadData();">
            Prev.
        </button>

        <select class="form-select" style="padding: 0px 35px 0px 5px; width: fit-content;"
                v-model="pagination.page" @change="loadData()" >
            <option v-for="i in pagination.last_page" :value="i">
                @{{ i }}
            </option>
        </select>

        <button type="button" class="btn btn-primary btn-sm mx-2" style="width: fit-content" 
            :disabled="pagination.page==pagination.last_page" @change="pagination.page++;loadData();">
            Next
        </button>
    </div>

</div>


    <script>
        const { createApp } = Vue
    
        createApp({
            data() {
                return {
                    errors:{},
                    data: [],
                    categories: [],
                    loader:false,
                    saveLoader: false,
                    pagination:{
                        page: 1,
                        per_page: 20,
                        last_page: 1,
                    },
                    form:{
                        id: null,
                        name: '',
                        description: '',
                        price: '',
                        category_id: null,
                        image: null,
                    }
                }
            },
            mounted(){
                //Load Categories
                axios.get(`/api/getAllCategories`)
                    .then((response)=>{
                        this.categories = response.data.data;
                    })
                    .catch((error)=>{
                        console.log(error);
                    });

                this.loadData();
            },
            methods:{
                //Load Products data with pagination
                loadData(){
                    this.loader = true;
                    axios.get(`/api/getProducts?per_page=${this.pagination.per_page}&page=${this.pagination.page}`)
                        .then((response)=>{
                            this.loader = false;
                            this.data = response.data.data.data; //Get Products
                            this.pagination.last_page = response.data.data.last_page; //Get total pages number
                        })
                        .catch((error)=>{
                            console.log(error);
                            this.loader = false;
                        });
                },
                cancel(){
                    this.form={
                        id: null,
                        name: '',
                        description: '',
                        price: '',
                        category_id: null,
                        image: null,
                    };
                },
                //Add or update a product
                save(){
                    this.saveLoader = true;
                    this.errors = {};
                    //add
                    if(this.form.id==null){
                        axios.post(`/api/addProduct`, this.form)
                            .then((response)=>{
                                this.saveLoader = false;
                                this.pagination.page = 1;
                                this.cancel();
                                this.loadData();
                            })
                            .catch((error)=>{
                                this.saveLoader = false;
                                if(error.response.data.errors) this.errors = error.response.data.errors;
                            });
                    }
                    //update
                    else{
                        axios.post(`/api/updateProduct`, this.form)
                            .then((response)=>{
                                this.saveLoader = false;
                                this.pagination.page = 1;
                                this.cancel();
                                this.loadData();
                            })
                            .catch((error)=>{
                                this.saveLoader = false;
                                if(error.response.data.errors) this.errors = error.response.data.errors;
                            });
                    }
                },
                //upload Image to server
                uploadImage(e){
                    let img = e.target.files[0]
                    let fd= new FormData()
                    
                    fd.append('image', img)
                    
                    axios.post('/api/uploadImage', fd)
                        .then(resp => {
                            this.form.image = resp.data.image;
                            console.log(this.form);
                        })
                },
                edit(product){
                    this.form.id = product.id;
                    this.form.name = product.name;
                    this.form.price = product.price;
                    this.form.description = product.description;
                    this.form.category_id = product.category_id;
                    this.form.image = product.image;
                },
                deleteProduct(id){
                    Swal.fire({
                        title: 'Are you really want to delete this product?',
                        showDenyButton: true,
                        confirmButtonText: 'Yes',
                        denyButtonText: `No`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            axios.post('/api/deleteProduct', {id})
                                .then(resp => {
                                    this.loadData();
                                })
                        }
                    });
                },
                toDate(date){
                    return moment(date).format('DD MMM. YYYY HH:mm')
                }
            }
        }).mount('#products_app')
      </script>

@endsection