<template>
    <div>
        ISBN: <input v-model="ISBN" @keyup.enter = "searchbook()"/>
        title: <input v-model="title"/>
        image:<input v-model="image"/>
        author: <input v-model="author"/>         
        translator: <input v-model="translator"/>
        publisher: <input v-model="publisher"/>
        pudate: <input v-model="pudate"/>
        authorintro:<input v-model="authorintro"/>
        summary: <input v-model="summary"/>
        catalog: <input v-model="catalog"/>
        price: <input v-model="price"/>
        pages: <input v-model="pages"/>
        booknum: <input v-model="booknum"/>
        <button @click = "createBook()">Create Book</button>
    </div> 
</template>
<script>
import axios from 'axios'
export default {
    data () {
        return {
            ISBN: '',
            title: '',
            image: '',
            author: '',            
            translator: '',
            publisher: '',
            pudate: '',
            authorintro: '',
            summary: '',
            catalog: '',
            price: '',
            pages: '',
            category_id: 0,
            location: '',
            booknum: 1
        }
    },
    methods: {
        async searchbook(){
            var url = 'https://api.douban.com/v2/book/isbn/' + this.ISBN
            var self = this
            $.ajax(url, {
                dataType: 'jsonp',
                success: function(data) {
                    console.log(data);
                    self.title = data.title               
                    self.image = data.image
                    self.author = ''
                    for(var authora of data.author){
                        self.author = self.author + authora + ','
                    }
                    for(var translatora of data.translator){
                        self.translator = self.translator + translatora + ','
                    }
                    self.publisher = data.publisher
                    self.pudate = data.pubdate
                    self.authorintro = data.author_intro
                    self.summary = data.summary
                    self.catalog = data.catalog
                    self.price = data.price
                    self.pages = data.pages
                }
            })
        },
        async createBook(){
            console.log('zhanglu')
            var res = await axios.post('/api/book/createbook', {
                category_id: this.category_id,
                isbn: this.ISBN,
                title: this.title,
                image: this.image,
                author: this.author,
                translator: this.translator,
                publisher: this.publisher,
                pudate: this.pubdate,
                authorintro: this.authorintro,
                summary: this.summary,
                catalog: this.catalog,
                price: this.price,
                pages: this.pages,
                location: this.location,
                booknum: this.booknum
            })
            console.log(res)
            console.log('zhang22')
        }
    }
}    
</script>
