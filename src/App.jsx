import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Video from './pages/Video';
import Login from './pages/Login';
import Register from './pages/Register';
import Home from './pages/Home';

function App() {
    return (
        <BrowserRouter>
            <Routes>
                <Route path='/' element={<Home />} />
                <Route path='/login' element={<Login />} />
                <Route path='/register' element={<Register />} />
                <Route path='/video/:id' element={<Video />} />
            </Routes>
        </BrowserRouter>
    );
}

export default App;
