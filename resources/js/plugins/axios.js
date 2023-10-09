import axios from 'axios';

export default axios.create({
  headers: {
    common: {
      'X-Requested-With': 'XMLHttpRequest'
    }
  }
})
