const { default: axios } = require("axios");

export default {
    verificarExistenciaTipoEmpleado()
    {
        return axios.get(route('tipoempleado.verify'));
    }
}
