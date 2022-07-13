import axios from "axios";
import { useEffect, useState } from "react";
import { API_URL, CATEGORIES_TABLE_NAME } from "../../utils/constants";
import { Category } from "../../utils/types";

const FoodList = () => {
  const [data, setData] = useState<{
    isLoaded: boolean;
    count: number;
    cateList: Category[] | [];
  }>({
    isLoaded: false,
    count: 0,
    cateList: [],
  });
  // const navigate = useNavigate();
  const getData = async () => {
    const res = await axios.get(API_URL + CATEGORIES_TABLE_NAME);
    const cateList = res.data.data;
    setData({
      isLoaded: true,
      count: res.data.count,
      cateList,
    });
  };
  useEffect(() => {
    if (!data.isLoaded) getData();
  }, [data.isLoaded]);
  console.log(data);

  return (
    <>
      <div className="text-start"></div>
      <table className="table container">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Ingedients</th>
          </tr>
        </thead>
        <tbody>
          {data.count ? (
            data.cateList.map((cate) => (
              <>
                <tr className="text-center display-6">
                  <td colSpan={5}>{cate.name}</td>
                  <td>{cate.foodList.count} food(s)</td>
                </tr>
                {cate.foodList.data.map((food) => (
                  <tr>
                    <td>{food.id}</td>
                    <td>
                      {food.name}
                    </td>
                  <td>{food.price}</td>
                    <td>
                      <img
                        src={food.img}
                        style={{ width: "5rem", height: "5rem" }}
                        alt=""
                      />
                    </td>
                    <td>{food.description}</td>
                    <td>{food.ingredients}</td>
                  </tr>
                ))}
              </>
            ))
          ) : (
            <tr>
              <td colSpan={5} className="text-center">
                No data has found!
              </td>
            </tr>
          )}
        </tbody>
      </table>
    </>
  );
};
export default FoodList;
