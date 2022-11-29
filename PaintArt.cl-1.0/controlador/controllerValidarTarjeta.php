<?php
include_once '../modelo/tarjetaUser.php';

class validarTarjeta{
    public function validarExistenciaTarjet($idUser){
        $tarjeta= new tarjetaUser();
        $resp= $tarjeta->buscarTarjetaUserId($idUser);
        if($resp==false)
        {
            echo '
                    <tr> 
                        <td style="text-align: center;" required><br><h3>Agregue una tarjeta</h3></td> 
                    </tr> 
                    <tr> 
                      <td><h5>Tipo de tarjeta</h5></td> 
                    </tr> 
                    <tr>
                        <td> 
                            <select name="tipoTarjeta" style=" border-radius: 0px; border: 0px;" class="form-select" id="exampleSelect1">
                                <option>Debito</option>
                                <option>Credito</option>
                              </select>
                        </td> 
                    </tr>
                    <tr> 
                        <td><h5>Numero de tajerta</h5></td> 
                    </tr> 
                    <tr>
                        <td>
                          <input name="numTarjeta" maxlength="16" minlength="16" type="number" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" placeholder="0000 0000 0000 0000" id="inputDefault" required> 
                        </td> 
                    </tr>
                    <tr> 
                        <td><h5>Fecha de caducidad</h5></td> 
                    </tr> 
                    <tr>
                        <td>
                            <select required name="mesC" style="width: 45%; float: left;" type="number" class="form-select" placeholder="mes" id="inputDefault">
                                <option hidden selected>Mes</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>  
                                <option value="4">04</option>  
                                <option value="5">05</option>  
                                <option value="6">06</option>  
                                <option value="7">07</option>  
                                <option value="8">08</option>  
                                <option value="9">09</option>  
                                <option value="10">10</option>  
                                <option value="11">11</option> 
                                <option value="12">12</option> 
                          </select>
                          
                            <input  required min="22" max="99" maxlength="2" name="Año" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 45%; float: right; margin-left: 20px;" type="number" type="text" class="form-control" placeholder="Año (ulimos dos digitos)" id="inputDefault"></td> 
                    </tr>
                    <tr>
                        <td><h5>Codigo de validacion</h5></td>
                    </tr>
                    <tr>
                        <td><input  required min="100" max="999" maxlength="3" name="codigoV" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  type="number" type="text" class="form-control" placeholder="123" id="inputDefault"></td> </td>
                    </tr>    
            ';
        }else{
            echo '
                    <tr style="background-color:white; position:relative; left:20px; top:20px">
                      <td>
                        <p></p>
                        <h5><b> La tajerta asociada es: **** **** **** '.substr($resp->__getNumTarjeta(),12).'</b></h5>
                        <p></p>
                        <b style="position:relative; left:20px">En caso de cambiar la informacion de la tarjeta asociada: </b><button type="button" style= "color:black"class="btn btn-link"><a href="medioPago.php">aqui</a></button>

                      </td>
                    </tr>
            ';
        }
    }
}



?>