import React from 'react';
import ReactDOM from 'react-dom';

import Dashboard from '../components/Dashboard';
let overview = JSON.parse( document.getElementById('overview-data').innerText  );
let divided = JSON.parse( document.getElementById('divided-data').innerText  );

let data = {
  overview,
  divided
}
ReactDOM.render(
  <Dashboard data={data}/>,
  document.getElementById('dashboard')
);
