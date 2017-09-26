import React from 'react';
import ReactDOM from 'react-dom';

import Dashboard from '../components/Dashboard';
let aggregate = JSON.parse( document.getElementById('aggreate-data').innerText  );
let user = JSON.parse( document.getElementById('user-data').innerText  );
let data = {
  aggregate,
  user
}
ReactDOM.render(
  <Dashboard data={data}/>,
  document.getElementById('dashboard')
);
