export type UserType = {
  id: number;
  name: string;
  email: string;
  createdAt: string;
  updatedAt: string;
};

export type AuthResponseType = {
  token: string;
  user: UserType;
};
