import './styles/app.scss';

import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';
import Home from './js/components/Home';

ReactDOM.render(<Router><Home /></Router>, document.getElementById('app'));
