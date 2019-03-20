(function() {
    function cargarUsuarios() {
        fetch('server.php/apis/usuario')
        .then(z => z.json())
        .then(function(resp) {
            let innerHTML = resp.map(function(unUsuario) {
                let str = "<option id='" + unUsuario.id + "'>" +
                unUsuario.apellido + ", " +
                unUsuario.nombre
                "</option>";
                return str;            
            });
            document.getElementById('cmbUsuario').innerHTML = innerHTML;
        });
    }

    function cargarEventos() {
        fetch('server.php/apis/evento')
        .then(z => z.json())
        .then(function(resp) {
            let innerHTML = resp.map(function(unEvento) {
                let str = "<option id='" + unEvento.id + "'>" +
                unEvento.nombre
                "</option>";
                return str;            
            });
            document.getElementById('cmbEventos').innerHTML = innerHTML;
        });
    }

    function asociarListeners() {

        function obtenerIdEvento() {
            let idxE = document.getElementById('cmbEventos').selectedIndex;
            let idEvento = document.getElementById('cmbEventos').options[idxE].id;
            return idEvento;
        }

        function obtenerIdUsurio() {
            let idxU = document.getElementById('cmbUsuario').selectedIndex;
            let idUsuario = document.getElementById('cmbUsuario').options[idxU].id;
            return idUsuario;
        }

        function suscribir(data) {            
            fetch('server.php/apis/registrousuario', {
                method: 'POST',
                body: JSON.stringify(data),
                headers:{
                  'Content-Type': 'application/json'
                }
              }).then(res => res.json())
              .then(response => {
                  console.log('Success:', JSON.stringify(response));
                  displayUsuariosEventos();
              })
              .catch(error => console.error('Error:', error));
        }

        function removerSuscripcion(data) {
            let = idusuarioevento = [data.idusuario, data.idevento].join('___');
            fetch('server.php/apis/registrousuario/'+idusuarioevento, {
                method: 'DELETE',
                body: JSON.stringify({}),
                headers:{
                  'Content-Type': 'application/json'
                }
              }).then(res => res.json())
              .then(response => {
                  console.log('Success:', JSON.stringify(response));
                  displayUsuariosEventos();
              })
              .catch(error => console.error('Error:', error));
        }

        document.addEventListener('click', function(e) {
            
            switch (e.target.id) {
                case 'suscribir':
                {
                    let idevento = obtenerIdEvento();
                    let idusuario = obtenerIdUsurio();

                    suscribir({idevento, idusuario});
                    break;
                }
                case 'anular':
                {
                    let idevento = obtenerIdEvento();
                    let idusuario = obtenerIdUsurio();
                    
                    removerSuscripcion({idevento, idusuario});
                    break;
                }
            }
        });
    }

    function displayUsuariosEventos() {
        fetch('server.php/apis/registrousuario')
        .then(z => z.json())
        .then(function(resp) {
            console.log(resp);
            window.data = { person: resp };
            let innerHTML = '';
            innerHTML += resp.map(function(recusu) {
                let str = "<b>nombre:</b> " + recusu.nombreusuario +
                "<b> apellido:</b> " +  recusu.apellido + 
                " <b>encuentro: </b> " + recusu.nombreencuentro +
                " <b>fecha: </b> " + recusu.fecha +
                "<hr />";
                return str;
            });
            document.getElementById('usuariosregistrados').innerHTML = innerHTML; 
        });
    }

    displayUsuariosEventos();
    cargarUsuarios();
    cargarEventos();
    asociarListeners();

})();

