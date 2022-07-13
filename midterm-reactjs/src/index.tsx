import ReactDOM from 'react-dom/client';
import { BrowserRouter, Navigate, Route, Routes } from 'react-router-dom';
import MainLayout from './layouts/MainLayout';
import FoodPage, { SearchFood } from './pages/foods';
import { FoodList } from './components/foods';

const root = ReactDOM.createRoot(
  document.getElementById('root') as HTMLElement
);
root.render(
  <BrowserRouter>
    <Routes>
      <Route path="/" element={<MainLayout/>}>
        <Route path="Foods/" element={<FoodPage />}>
          <Route path="Home" element={<Navigate replace to="/Foods" />} />
          <Route path="" element={<FoodList />} />
          <Route path="Search" element={<SearchFood/>} />
        </Route>
      </Route>
    </Routes>
  </BrowserRouter>
);
