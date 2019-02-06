function open_pedido(item){
    menus.item = item
    console.log(this.item)
    $("#modal_new_pedido").modal('show')
}

const menus = new Vue({
    el: '#main',
    created(){
        this.pre_load_menu()
    },
    data: {
        route: route,
        categoria: '',
        menu: [],
        item: {
            categoria: {
                nombre: ''
            }
        },
        cantidad_item: '',
    },
    methods: {
        alert_loader(options){
			swal({
                title: "Espere un momento!",
                text: options.text,
                icon: this.route + "/imagenes/"+options.icon+".gif",
                button: {
                    text: "Entiendo",
                    value: false,
                    closeModal: false,
                },
                closeOnClickOutside: options.click,
                closeOnEsc: options.esc,
				dangerMode: true,
				timer: 10000,
            });
        },
        alert_success(options){
            // text, click, esc, time = false
			swal({
				title: "Excelente!",
				text: options.text,
				icon: "success",
				button: {
					text: "Ok"
				},
				dangerMode: true,
				closeOnClickOutside: options.click,
				closeOnEsc: options.esc,
				timer: options.time,
			});
        },
        pre_load_menu(){
            this.categoria = $("#categoria").val()
            let url_charge_menu = this.route + '/charge/menu/' + this.categoria
            axios.get(url_charge_menu).then(response => {
                //console.log(response.data)
                this.menu = response.data.menu
            }).catch(error => {
                console.log(error)
                console.log(error.response)
            })
        },
        open_pedido(item){
            this.item = item
            console.log(this.item)
            $("#modal_new_pedido").modal('show')
        },
        save_pedido(){
            let url = this.route + "/save/pedido"
            axios.post(url, {item: this.item, cantidad: this.cantidad_item}).then(response => {
                console.log(response.data)
                toastr.success('Pedido Realizado con exito!', 'Excelente!.')
                $("#modal_new_pedido").modal('hide')
                this.pre_load_menu()
            }).catch(error => {
                console.log(error)
            })
        }
    }
});