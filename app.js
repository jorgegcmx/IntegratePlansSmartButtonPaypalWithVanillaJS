const cards = document.getElementById('cards')
const items = document.getElementById('items')
const footer = document.getElementById('footer')
const templateCard = document.getElementById('template-card').content
const templateFooter = document.getElementById('template-footer').content

const templateCarrito = document.getElementById('template-carrito').content
const total = document.getElementById("total").innerText;
const fragment = document.createDocumentFragment()
var totalP = 0;

let carrito = {}
// Eventos
// El evento DOMContentLoaded es disparado cuando el documento HTML ha sido completamente cargado y parseado
document.addEventListener('DOMContentLoaded', e => { fetchData() });
cards.addEventListener('click', e => { addCarrito(e) });
items.addEventListener('click', e => { btnAumentarDisminuir(e) })



// Traer productos
const fetchData = async () => {
    const res = await fetch('data.json');
    const data = await res.json()
    // console.log(data)
    pintarCards(data)

}

// Pintar productos
const pintarCards = data => {
    data.forEach(item => {
        templateCard.querySelector('h6').textContent = item.title
        templateCard.querySelector('.precio').textContent = item.precio
        templateCard.querySelector('input').dataset.id = item.id
        templateCard.querySelector('label').textContent = item.boton
        const clone = templateCard.cloneNode(true)
        fragment.appendChild(clone)
    })
    cards.appendChild(fragment)
}

// Agregar al carrito
const addCarrito = e => {
    if (e.target.classList.contains('form-check-input')) {
        //console.log(e.target.parentElement)
        if (e.target.checked) {
            setCarrito(e.target.parentElement)

        } else {

            const producto = carrito[e.target.dataset.id]
            producto.cantidad--
            if (producto.cantidad === 0) {
                delete carrito[e.target.dataset.id]
            } else {
                carrito[e.target.dataset.id] = { ...producto }
            }
            pintarCarrito()
        }

    }
    e.stopPropagation()
}

const setCarrito = item => {
    // console.log(item)
    const producto = {
        title: item.querySelector('h6').textContent,
        precio: item.querySelector('.precio').textContent,
        id: item.querySelector('input').dataset.id,
        cantidad: 1
    }
    // console.log(producto)
    if (carrito.hasOwnProperty(producto.id)) {
        // producto.cantidad = carrito[producto.id].cantidad + 1
    }

    carrito[producto.id] = { ...producto }

    pintarCarrito()
}

const pintarCarrito = () => {
    items.innerHTML = ''

    Object.values(carrito).forEach(producto => {
        templateCarrito.querySelectorAll('td')[0].textContent = producto.title
        templateCarrito.querySelector('span').textContent = producto.precio //* producto.cantidad
        // //botones
        //templateCarrito.querySelector('.btn-danger').dataset.id = producto.id
        const clone = templateCarrito.cloneNode(true)
        fragment.appendChild(clone)
    })
    items.appendChild(fragment)
    pintarFooter()

}

const pintarFooter = () => {
    footer.innerHTML = ''
    const nPrecio = Object.values(carrito).reduce((acc, { cantidad, precio }) => acc + ((cantidad * precio)), 0)
    // console.log(nPrecio)
    const totalFin = nPrecio + parseInt(total, 10)
    templateFooter.querySelector('span').textContent = totalFin
    const clone = templateFooter.cloneNode(true)
    fragment.appendChild(clone)
    footer.appendChild(fragment)

}



const btnAumentarDisminuir = e => {
    if (e.target.classList.contains('btn-danger')) {
        const producto = carrito[e.target.dataset.id]
        producto.cantidad--
        if (producto.cantidad === 0) {
            delete carrito[e.target.dataset.id]
        } else {
            carrito[e.target.dataset.id] = { ...producto }
        }
        pintarCarrito()
    }
    e.stopPropagation()
}


const sendEmail = (nombre, email, status, id, importe) => {


    var dataJson = new Object();
    dataJson = [{ "Cliente": nombre, "email": email, "status": status, "id": id, "importe": importe }];
    var Pedido = new Object();

    Pedido = [{}];
    Pedido.push(carrito);
    dataJson.push(Pedido);

    console.log(dataJson);

    fetch('http://localhost:8090/carrito-vanilla-js/post.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Access-Control-Allow-Origin': '*'
        },
        body: JSON.stringify(dataJson),

    }).then((response) => {
        return response.text();
    }).then(data => {
        console.log(data)
    }).catch((error) => {
        console.log(error)
    })


}


initPayPalButton()
function initPayPalButton() {

    paypal.Buttons({
        style: {
            shape: 'rect',
            color: 'blue',
            layout: 'vertical',
            label: 'pay',
        },
        createOrder: function (data, actions) {
            const Pago = document.getElementById("total").innerText;

            //sendEmail("nombre", "email", "status", "id", Pago);

            return actions.order.create({
                purchase_units: [{ "amount": { "currency_code": "USD", "value": Pago } }]
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {              

                const id = details.id;
                const status = details.status;
                const nombre = details.payer.name.given_name + ' ' + details.payer.name.surname;
                const email = details.payer.email_address;
                const total = details.purchase_units[0].amount.value;
                console.log(details);

                console.log(total);
                
                sendEmail(nombre, email, status, id, total);

                alert('Transaction completed by ' + details.payer.name.given_name + '!');
            });
        },
        onError: function (err) {
            console.log(err);
        }
    }).render('#paypal-button-container');
}



