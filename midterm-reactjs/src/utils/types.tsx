export type Category = {
  id: number,
  name: string,
  foodList: {count: number, data: Food[], error?: string, status?: string}
}
export type Food = {
  id?: number,
  cateId: number,
  name: string,
  price: number,
  ingredients: string,
  description: string,
  img: string,
  createdAt?: string,
  updatedAt?: string
}
export enum Action {
  CREATE, UPDATE
}